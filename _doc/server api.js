/**
 * server api
 */
var api = [
	{
		"name":"获取单个对象",
		"request":{
			"method":"GET",
			"uri":"/object/{id}",
			"contentType":"application/json",
			"query":{
				"get_meta":true,
				"get_mod":true,
				"get_relative":true,
				"get_status":true,
				"get_tag":true
			}
		},
		"response":{
			"header":{
				"contentType":"application/json"
			},
			"body":objectData
		}
	},
	{
		"name":"更新单个对象",
		"request":{
			"method":"POST",
			"uri":"/object/{id}",
			"contentType":"application/json",
			"query":objectData
		}
	},
	{
		"name":"创建单个对象",
		"request":{
			"method":"PUT",
			"uri":"/object",
			"contentType":"application/json",
			"query":objectData
		},
		response:"{id}"
	},
	{
		"name":"获取对象列表",
		"request":{
			"uri":"/object",
			"query":listArgs
		},
		"response":{
			"body":{
				"total":1000,//去处分页参数后的对象数目
				"data":[
					objectData,
					objectData
				]
			}
		}
	},
	{
		"name":"用户登录",
		"request":{
			"method":"POST",
			"uri":"/login",
			"contentType":"application/json",
			"query":{
				"username":"",
				"password":"",//开发阶段，明文
				"remember":FALSE,
			}
		}
	},
	{
		"name":"用户登出",
		"request":{
			"method":"GET",
			"uri":"/logout"
		}
	},
	{
		"name":"页面框架",
		"request":{
			"uri":"/"
		}
	},
	{
		"name":"导航菜单",
		"request":{
			"uri":"/nav",
		},
		"response":{
			"body":[
				{
					"id":"1",
					"name":"客户",
					"href":'/object?query=%7Btype:%22%E5%AE%A2%E6%88%B7%22%7D',
					"sub":[
						{
							"id":"2",
							"name":"潜在客户",
							"href":"/object?query=%7Btype:%22%E5%AE%A2%E6%88%B7%22,tag:%5B%22%E6%BD%9C%E5%9C%A8%E5%AE%A2%E6%88%B7%22%5D%7D",
						}
					]
				}
			]
		}
	},
	{
		"name":"菜单存储",
		"request":{
			"method":"PUT",
			"uri":"/nav",
			"query":{
				"name":"潜在客户",//菜单的显示名称
				"uri":"/object?query=%7Btype:%22%E5%AE%A2%E6%88%B7%22,tag:%5B%22%E6%BD%9C%E5%9C%A8%E5%AE%A2%E6%88%B7%22%5D%7D",
				"parent":"1"
			}
		}
	}
];

/**
 * 对象数据结构
 */
var objectData={
	"id":0,
	"type":"",//对象类型如people,contact,cases,project
	"num":"",//对象的编号，字符串
	"name":"",//对象的显示名称
	"additional_fields":"",//非必有，根据不同type的对象，可能有些额外的根字段
	"meta":[//非必有，获得对象时get_meta参数决定
		{
			"id":0,
			"name":"",
			"content":"",
			"comment":""
		}
	],
	"mod":{//非必有，获得对象时get_mod参数决定
		"6343":{"read":true,"write":true}//一组可变权限/状态名
	},
	"relative":[//非必有，获得对象时get_relative参数决定
		{
			"id":0,//关系id
			"num":"",//关系编号，比如一个学生在一个班级中的学号
			"relation":"",
			"mod":{"people":{"deleted":false,"read":false}},//与一类对象的一组可变权限/状态名
			"weight":0.00,//比重，同relation的比重之和不应超过1
			"till":"1970-01-01",//关系结束时间
			"relative":0,//关联对象id
			"type":"",//关连对象类型
			"name":""//关连对象显示名称
		}
	],
	"status":[//非必有，获得对象时get_status参数决定
		{
			"id":0,
			"name":"",
			"type":"",
			"datetime":"",
			"content":"",
			"comment":""
		}
	],
	"tag":[//非必有，获得对象时get_tag参数决定
		{
			"id":0,
			"name":"",
			"type":"",//标签类型，分类的分类，如“阶段”，“领域”,
			"color":"#000"
		}
	]
};

/**
 * 对象列表搜索参数
 */
var listArgs={
	"id_in":[],
	"id_less_than":0,
	"id_greater_than":0,
	"name":"",//模糊匹配
	"type":"",//对象类别
	"num":"",//模糊匹配
	"display":true,
	//"company":0,
	"uid":0,//对象的创建人

	"tags":{"tagType":tagName,"0":tagName},//包含一组标签
	"without_tags":{"tagType":tagName,"0":tagName},//不包含一组标签
	"get_tags":false,

	"has_meta":{"metaName":metaContent,"0":metaName},//包含一组资料项，一组资料项为某值
	"get_meta":false,

	"is_relative_of":0,//根据本对象获得相关对象
		"is_relative_of__relation":"",//只查找具有某关系的相关人
	"has_relative_like":0,//根据相关对象获得本对象
		"has_relative_like__relation":"",
	"is_secondary_relative_of":0,//右侧相关对象的右侧相关对象，“下属的下属”
		"is_secondary_relative_of__media":"",//中间对象的type
	"is_both_relative_with":0,//右侧相关对象的左侧相关对象，“具有共同上司的同事”
		"is_both_relative_with__media":"",
	"has_common_relative_with":0,//左侧相关对象的右侧相关对象，“具有共同下属的上司”
		"has_common_relative_with__media":"",
	"has_secondary_relative_like":0,//左侧相关对象的左侧相关对象，“上司的上司”
		"has_secondary_relative_like__media":"",
	"get_relative":false,

	"status":{
		"name":[//存在两种判断方式
			{"from":"from_syntax","to":"to_syntax","format":"timestamp/date/datetime"},
			false//bool，仅过滤出包含或不包含该状态的对象
		],
		//例子
		"首次接洽":{"from":1300000000,"to":1300100000,"format":"timestamp"},
		"立案":{"from":"2013-01-01","to":"2013-06-30"},
		"结案":true
	},
	"get_status":false,

	"orderby":[//支持2种数据格式
		"id desc, name asc",
		[
			["id","desc"],
			["name","asc"]
		]
	],
	"limit":[//支持2种数据格式
		10,//直接给出需要的行数,
		[10,20]//需要的行数, 起点偏移
	]
};