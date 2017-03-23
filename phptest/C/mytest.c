static ngx_command_t ngx_http_mytest_commands[] = {
    {
        ngx_string("mytest"),
        NGX_HTTP_MAIN_CONF|NGX_HTTP_SRV_CONF|NGX_HTTP_LOC_CONF|NGX_HTTP_LMT_CONF|NGX_CONF_NOARGS, ngx_http_mytest,
        NGX_HTTP_LOC_CONF_OFFSET,
        0,
        NULL
    },
    ngx_null_command
};

static char * ngx_http_mytest(ngx_conf_t *cf, ngx_command_t cmd, void conf) {
    /*首先找到mytest配置项所属的配置块,
    *clcf;clcf看上去像是location块内的数据结构,其实不然,它可以是main、srv或者loc级别配置项,也就是说,在每个
    http{}和server{}内也都有一个ngx_http_core_loc_conf_t结构体
    */
    ngx_http_core_loc_conf_t clcf = ngx_http_conf_get_module_loc_conf(cf, ngx_http_core_module);
    /*HTTP框架在处理用户请求进行到
    NGX_HTTP_CONTENT_PHASE阶段时,如果请求的主机域名、URI与
    mytest配置项所在的配置块相匹配,就将调用我们实现的
    ngx_http_mytest_handler方法处理这个请求
    */
    clcf->handler = ngx_http_mytest_handler; return NGX_CONF_OK;
}

typedef enum {
    // 在接收到完整的HTTP头部后处理的HTTP阶段
    NGX_HTTP_POST_READ_PHASE = 0,

    /*在还没有查询到URI匹配的location前,这时rewrite重写URL也作为一个独立的HTTP阶段*/
    NGX_HTTP_SERVER_REWRITE_PHASE,

    /*根据URI寻找匹配的location,这个阶段通常由ngx_http_core_module模块实现,不建议其他HTTP模块重新定义这一阶段的行为*/
    NGX_HTTP_FIND_CONFIG_PHASE,

    /*
    在NGX_HTTP_FIND_CONFIG_PHASE阶段之后重写URL的意义与NGX_HTTP_SERVER_REWRITE_PHASE阶段显然是不同的,因为这两者会导致查找到不同的
    location块(location是与URI进行匹配的)
    */
    NGX_HTTP_REWRITE_PHASE,

    /*
    这一阶段是用于在rewrite重写URL后重新跳到NGX_HTTP_FIND_CONFIG_PHASE阶段,找到与新的URI匹配的location。所以,这一阶段是无法由第三方
    HTTP模块处理的,而仅由
    ngx_http_core_module模块使用
    */
    NGX_HTTP_POST_REWRITE_PHASE,

    // 处理NGX_HTTP_ACCESS_PHASE阶段前,HTTP模块可以介入的处理阶段
    NGX_HTTP_PREACCESS_PHASE,

    //这个阶段用于让HTTP模块判断是否允许这个请求访问Nginx服务器
    NGX_HTTP_ACCESS_PHASE,

    /*
    当NGX_HTTP_ACCESS_PHASE阶段中HTTP模块的handler处理方法返回不允许访问的错误码时(实际是NGX_HTTP_FORBIDDEN或者
    NGX_HTTP_UNAUTHORIZED),这个阶段将负责构造拒绝服务的用户响应。所以,这个阶段实际上用于给
    NGX_HTTP_ACCESS_PHASE阶段收尾
    */
    NGX_HTTP_POST_ACCESS_PHASE,

    /*
    这个阶段完全是为了try_files配置项而设立的。当HTTP请求访问静态文件资源时,try_files配置项可以使这个请求顺序地访问多个静态文件资源,
    如果某一次访问失败,则继续访问try_files中指定的下一个静态资源。另外,这个功能完全是在NGX_HTTP_TRY_FILES_PHASE阶段中实现的
    */
    NGX_HTTP_TRY_FILES_PHASE,

    // 用于处理HTTP请求内容的阶段,这是大部分HTTP模块最喜欢介入的阶段
    NGX_HTTP_CONTENT_PHASE,

    /*
    处理完请求后记录日志的阶段。例如,ngx_http_log_module模块就在这个阶段中加入了一个handler处理方法,使得每个
    HTTP请求处理完毕后会记录access_log日志
    */
    NGX_HTTP_LOG_PHASE
} ngx_http_phases;

static ngx_http_module_t ngx_http_mytest_module_ctx = {
    NULL, /* preconfiguration */
    NULL, /* postconfiguration */
    NULL, /* create main configuration */
    NULL, /* init main configuration */
    NULL, /* create server configuration */
    NULL, /* merge server configuration */
    NULL, /* create location configuration */
    NULL /* merge location configuration */
};

ngx_module_t ngx_http_mytest_module = {
    NGX_MODULE_V1,&ngx_http_mytest_module_ctx, /* module context */
    ngx_http_mytest_commands, /* module directives */
    NGX_HTTP_MODULE, /* module type */
    NULL, /* init master */
    NULL, /* init module */
    NULL, /* init process */
    NULL, /* init thread */
    NULL, /* exit thread */
    NULL, /* exit process */
    NULL, /* exit master */
    NGX_MODULE_V1_PADDING
};


static ngx_int_t ngx_http_mytest_handler(ngx_http_request_t *r) {
    // 必须是GET或者HEAD方法,否则返回405 Not Allowed
    if (!(r->method & (NGX_HTTP_GET|NGX_HTTP_HEAD))) {
        return NGX_HTTP_NOT_ALLOWED;
    }
    // 丢弃请求中的包体ngx_int_t rc = ngx_http_discard_request_body(r); if (rc != NGX_OK) {
    return rc;
}
/*设置返回的
Content-Type。注意,ngx_str_t有一个很方便的初始化宏ngx_string,它可以把ngx_str_t的data和len成员都设置好
*/
    ngx_str_t type = ngx_string("text/plain"); // 返回的包体内容
    ngx_str_t response = ngx_string("Hello World!"); // 设置返回状态码r->headers_out.status = NGX_HTTP_OK; // 响应包是有包体内容的,需要设置
    Content-Length长度
    r->headers_out.content_length_n = response.len; // 设置Content-TypeContent-Type
    r->headers_out.content_type = type; // 发送HTTP头部
    rc = ngx_http_send_header(r);
    if (rc == NGX_ERROR || rc > NGX_OK || r->header_only) {
        return rc;
    }
    // 构造ngx_buf_t结构体准备发送包体ngx_buf_t *b;
    b = ngx_create_temp_buf(r->pool, response.len);
    if (b == NULL) {
        return NGX_HTTP_INTERNAL_SERVER_ERROR;
    }
    // 将Hello World复制到ngx_buf_t指向的内存中
    ngx_memcpy(b->pos, response.data, response.len); // 注意,一定要设置好last指针
    b->last = b->pos + response.len; // 声明这是最后一块缓冲区
    b->last_buf = 1;
    // 构造发送时的ngx_chain_t结构体ngx_chain_t out;
    // 赋值ngx_buf_t
    out.buf = b;NULL
    out.next = NULL;
    /*最后一步为发送包体,发送结束后
    HTTP框架会调用
    ngx_http_finalize_request方法结束请求
    */
    return ngx_http_output_filter(r, &out); `
    }
