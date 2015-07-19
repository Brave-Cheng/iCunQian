Restful API 【文档与规范 】【接口访问与参数】
---------

######Notes: 如果接口返回404可能出现的原因：
>【1、一定要注意是否已经连接VPN】  
>【2、检查在URL中是否添加code（expacta）参数】


#接口列表总览

+   获取Token
    
+   获取产品列表
    
+   获取银行信息列表
    
+   获取属性值列表

+   设备注册推送服务（APP订阅）回调接口

#接口请求说明

##1、获取Token接口

###请求地址(Url)

+   [Localhost: ](http://deposit.trunk.local/Api/Login) http://deposit.trunk.local/Api/Login
+   [Trunk-Server:  ](http://deposit.trunk.test.expacta.com.cn/Api/Login) http://deposit.trunk.test.expacta.com.cn/Api/Login

###请求方式(Method)
```php
POST
```
###请求参数参数(Request Paramters)
```json
{
    "code":"expacta",
    "api_key":"7b50ab2c9f0063a8e849252fc54579b92657f149"
}
```
###响应结果(Response)
```json
{"token":"8e16cdaa0061ee89106b9112890a419397b46f36"}
```



##2、获取产品列表接口

###请求地址(Url)

+   [Localhost: ](http://deposit.trunk.local/Api/FinanceProduct/expacta/Products) http://deposit.trunk.local/Api/FinanceProduct/expacta/Products
+   [Trunk-Server:  ](http://deposit.trunk.test.expacta.com.cn/Api/FinanceProduct/expacta/Products) http://deposit.trunk.test.expacta.com.cn/Api/FinanceProduct/expacta/Products

###请求方式(Method)
```php
GET
```
###请求参数参数(Request Paramters)
> ####Header
>>  
+   Authorization = 8e16cdaa0061ee89106b9112890a419397b46f36    (__token__)(**必填**)  
+   Accept-Encoding = gzip  (**选填**)
>####Urls
>>
+   **since/1400057694**
>>>*    /Api/FinanceProduct/expacta/Products/since/1400057694
>>>*    获取数据时间戳，默认是接口请求时间戳
+   **limit/1000**
>>>*    /Api/FinanceProduct/expacta/Products/limit/1000
>>>*    请求数据大小，默认是1000条数据

###响应结果(Response)
```json
{
    "total_products_returned": 1,            "产品数量"  , 
    "since": 1398873600,                     "请求时间戳",
    "total_products": 4503,                  "产品总数量",
    "products":                              "产品细目"
    [
        {
           "actual_rate":                   "实际年化收益",
           "announce":                      "产品公告",
           "bank_name":                     "银行名称（全称）",
           "cost":                          "产品费用",
           "created_at":                    "创建时间",
           "currency":                      "币种, eg:[人民币,美元,港币,英镑,欧元,澳元,其他币种]",
           "deadline":                      "到期日",
           "events":                        "优惠活动",
           "expected_rate":                 "预期年华收益%",
           "feature":                       "产品特色",
           "invert_increase_amount":        "投资递增金额",
           "invest_cycle":                  "投资期限",
           "invest_scope":                  "投资范围",
           "invest_start_amount":           "投资起始金额（万元）",
           "name":                          "产品名称",
           "pay_period":                    "付息周期",
           "product_type":                  "产品类型",
           "profit_desc":                   "收益率说明",
           "profit_start_date":             "收益起始日",
           "profit_type":                   "收益类型,eg: [保本固定收益,保本浮动收益,非保本浮动收益]",
           "purchase":                      "申购条件",
           "raise_condition":               "募集规划条件",
           "region":                        "发型地区，eg：德州,济南,济宁,临沂,青岛,天津,烟台",
           "request_financial_id":          "产品唯一主键",
           "sale_end_date":                 "销售截止日, eg:2014-05-26",
           "sale_start_date":               "销售起始日, eg:2014-05-20",
           "status":                        "销售状态，eg:[预售，在售，过期]",
           "stop_condition":                "提前终止条件",
           "sync_status":                   "数据状态 [0=>新增 1=>修改 2=>删除]"
           "target":                        "发行对象",
           "updated_at":                    "更新时间,eg:2014-05-20 17:50:21",
           "warnings":                      "风险提示"
       },       
    ]       
}
```



##3、获取银行信息列表接口

###请求地址(Url)

+   [Localhost: ](http://deposit.trunk.local/Api/Bank/expacta/Banks) http://deposit.trunk.local/Api/Bank/expacta/Banks
+   [Trunk-Server:  ](http://deposit.trunk.test.expacta.com.cn/Api/Bank/expacta/Banks) http://deposit.trunk.test.expacta.com.cn/Api/Bank/expacta/Banks

###请求方式(Method)
```php
GET
```
###请求参数参数(Request Paramters)
> ####Header
>>  
+   Authorization = 8e16cdaa0061ee89106b9112890a419397b46f36    (__token__)(**必填**)  
+   Accept-Encoding = gzip  (**选填**)
>####Urls
>>
+   **since/1400057694**    
>>>*    /Api/FinanceProduct/expacta/Banks/since/1400057694
>>>*    获取数据时间戳，默认是接口请求时间戳
+   **limit/1000**           
>>>*    /Api/FinanceProduct/expacta/Banks/limit/1000
>>>*    请求数据大小，默认是100条数据

###响应结果(Response)
```json
{
   "total_banks_returned": 1,  "银行数量",
   "since": 1398873600,        "请求时间戳",
   "total_banks": 75,          "银行总数量",
   "banks":                    "银行细目"
   [
       {
           "id":          "银行唯一主键",
           "name":        "银行名称（全称）",
           "short_name":  "银行简称",
           "short_char":  "银行简称首字拼音, eg: GSYH",
           "phone":       "银行电话"
           "sync_status":   "数据状态 [0=>新增 1=>修改 2=>删除]",
           "create_at":     "创建时间"
           "update_at":     "更新时间"
       }
   ]
}
```



##4、获取属性值列表接口

###请求地址(Url)

+   [Localhost: ](http://deposit.trunk.local/Api/Attribute/expacta/Attrbites) http://deposit.trunk.local/Api/Attribute/expacta/Attrbites
+   [Trunk-Server:  ](http://deposit.trunk.test.expacta.com.cn/Api/Attribute/expacta/Attrbites) http://deposit.trunk.test.expacta.com.cn/Api/Attribute/expacta/Attrbites

###请求方式(Method)
```php
GET
```
###请求参数参数(Request Paramters)
> ####Header
>>  
+   Authorization = 8e16cdaa0061ee89106b9112890a419397b46f36    (__token__)(**必填**)  
+   Accept-Encoding = gzip  (**选填**)
>####Urls
>>
+   __since/1400057694__   
>>>*    /Api/FinanceProduct/expacta/Banks/since/1400057694 
>>>*    获取数据时间戳，默认是接口请求时间戳
+   __limit/1000__          
>>>*    /Api/FinanceProduct/expacta/Banks/limit/1000          
>>>*    请求数据大小，默认是100条数据
+   __type/profit_type__                  
>>>*    /Api/Bank/expacta/Banks/type/profit_type
>>>*    获取指定属性的所有属性值

###响应结果(Response)
```json
{
   "status":                "属性总记录数",
   "attributes":
   [
       {
           "id":            "属性值唯一主键",
           "type":          "属性名称",
           "value":         "属性值"
           "sync_status":   "数据状态 [0=>新增 1=>修改 2=>删除]",
           "create_at":     "创建时间"
           "update_at":     "更新时间"
       }
   ]
}
```


##5、设备注册推送服务（APP订阅）回调接口（_待补充完整_）

###请求地址(Url)

+   [Localhost: ](http://deposit.trunk.local/Api/PushService/expacta/Subscribe) http://deposit.trunk.local/Api/PushService/expacta/Subscribe
+   [Trunk-Server:  ](http://deposit.trunk.test.expacta.com.cn/Api/PushService/expacta/Subscribe) http://deposit.trunk.test.expacta.com.cn/Api/PushService/expacta/Subscribe

###请求方式(Method)
```php
POST
```
###请求参数参数(Request Paramters)
```json
{
    "app_name":"iCunQian",                                          应用名称 (_必填_)
    "device_token":"7b50ab2c9f0063a8e849252fc54579b92657f149",      Token值  (_必填_)
    "device_model":"ios",                                           设备型号 (_必填_) ~只有ios,andriod两个值~
    "device_name":"Mi-ONE Plus",                                    设备名称 (_必填_)
    "profit_type":"1",                                              收益类型 (_必填_)
    "expected_yield":"3.5",                                         预期收益率 (_必填_)
    "financial_cycle":"10",                                         理财周期 (_必填_)
    "app_version":"1.0",                                            应用版本
    "device_uid":"7bsdfasfd",                                       设备唯一编号  (_必填_)
    "device_version":"7.0",                                         设备版本号
    "city":"成都",                                                  城市
    "bank":"招商银行",                                              银行信息
    "subscribe_id":""                                               设备订阅号【新增，则为空，否则为修改】
}
```
###响应结果(Response)

####成功
>>
```json
{
   "subscribe_id": 6,           订阅号Id
   "affected": 1                影响的行数
}
```
####失败
>>  
```json
{"error_msg":"Error Message."}
```

