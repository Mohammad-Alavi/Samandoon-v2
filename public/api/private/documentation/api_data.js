define({ "api": [
  {
    "group": "Comment",
    "name": "createComment",
    "type": "POST",
    "url": "/v1/content/:content_id/comment",
    "title": "Create Comment",
    "description": "<p>Create a Comment</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authorized"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "body",
            "description": "<p>Comment text</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "parent_id",
            "description": "<p>Parent id of the comment</p>"
          }
        ]
      }
    },
    "filename": "app/Containers/Comment/UI/API/Routes/CreateComment.v1.private.php",
    "groupTitle": "Comment",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n    \"object\": \"Comment\",\n        \"id\": \"qmv7dk48x5b690wx\",\n        \"body\": \"شسیشسی\",\n        \"content_id\": \"eq6am74064z0vpbn\",\n        \"user_id\": \"bml0wd39b5pkznag\",\n        \"parent_id\": \"qnwmkv5704blag6r\",\n        \"created_at\": {\n        \"date\": \"2019-01-07 14:46:30.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"Asia/Tehran\"\n        },\n        \"updated_at\": {\n        \"date\": \"2019-01-07 14:46:30.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"Asia/Tehran\"\n        }\n    },\n    \"meta\": {\n    \"include\": [],\n        \"custom\": []\n    }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "Comment",
    "name": "deleteComment",
    "type": "DELETE",
    "url": "/v1/user/:id/content/:id/comment/:id",
    "title": "Delete Comment",
    "description": "<p>Delete a Comment by its ID</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated|Owner"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Comment/UI/API/Routes/DeleteComment.v1.private.php",
    "groupTitle": "Comment"
  },
  {
    "group": "Comment",
    "name": "getAllComments",
    "type": "GET",
    "url": "/v1/comment",
    "title": "Get All Comments of a Content",
    "description": "<p>Get All Comments of a Content by its Content ID</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "filename": "app/Containers/Comment/UI/API/Routes/GetAllComments.v1.private.php",
    "groupTitle": "Comment",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n    \"object\": \"Comment\",\n        \"id\": \"qmv7dk48x5b690wx\",\n        \"body\": \"شسیشسی\",\n        \"content_id\": \"eq6am74064z0vpbn\",\n        \"user_id\": \"bml0wd39b5pkznag\",\n        \"parent_id\": \"qnwmkv5704blag6r\",\n        \"created_at\": {\n        \"date\": \"2019-01-07 14:46:30.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"Asia/Tehran\"\n        },\n        \"updated_at\": {\n        \"date\": \"2019-01-07 14:46:30.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"Asia/Tehran\"\n        }\n    },\n    \"meta\": {\n    \"include\": [],\n        \"custom\": []\n    }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "Comment",
    "name": "getComment",
    "type": "GET",
    "url": "/v1/comment/:id",
    "title": "Find Comment by ID",
    "description": "<p>Find a comment by it's ID</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "filename": "app/Containers/Comment/UI/API/Routes/GetComment.v1.private.php",
    "groupTitle": "Comment",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n    \"object\": \"Comment\",\n        \"id\": \"qmv7dk48x5b690wx\",\n        \"body\": \"شسیشسی\",\n        \"content_id\": \"eq6am74064z0vpbn\",\n        \"user_id\": \"bml0wd39b5pkznag\",\n        \"parent_id\": \"qnwmkv5704blag6r\",\n        \"created_at\": {\n        \"date\": \"2019-01-07 14:46:30.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"Asia/Tehran\"\n        },\n        \"updated_at\": {\n        \"date\": \"2019-01-07 14:46:30.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"Asia/Tehran\"\n        }\n    },\n    \"meta\": {\n    \"include\": [],\n        \"custom\": []\n    }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "Content",
    "name": "createContent",
    "type": "POST",
    "url": "/v1/user/:id/content",
    "title": "Create Content",
    "description": "<p>Create Content</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authorized"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "array",
            "allowedValues": [
              "article",
              "repost",
              "link"
            ],
            "optional": false,
            "field": "addon",
            "defaultValue": "article=>true",
            "description": "<p>example: addon[article =&gt; true, repost =&gt; true]</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "article",
            "description": "<p>article[title =&gt; title here, text =&gt; text here]</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "repost",
            "description": "<p>repost[referenced_content_id =&gt; reloj65plp4v8ndy]</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "link",
            "description": "<p>link[link_url =&gt; https://stackoverflow.com/questions/38726530/replace-snake-case-to-camelcase-in-part-of-a-string]</p>"
          }
        ]
      }
    },
    "filename": "app/Containers/Content/UI/API/Routes/CreateContent.v1.private.php",
    "groupTitle": "Content",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n    \"object\": \"Content\",\n        \"id\": \"7vmg6q36ak4b8kzr\",\n        \"created_at\": {\n        \"date\": \"2019-01-04 05:17:42.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"Asia/Tehran\"\n        },\n        \"updated_at\": {\n        \"date\": \"2019-01-04 05:17:42.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"Asia/Tehran\"\n        },\n        \"deleted_at\": null,\n        \"add-on\": {\n        \"article\": {\n            \"object\": \"Article\",\n                \"id\": \"ojl0865y0j4bgmew\",\n                \"title\": \"شسیشسی\",\n                \"text\": \"این متن یک نوشته است\",\n                \"content_id\": \"7vmg6q36ak4b8kzr\",\n                \"created_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                },\n                \"updated_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                }\n            },\n            \"repost\": {\n            \"object\": \"Repost\",\n                \"id\": \"kxeml73oyx4d9qbr\",\n                \"content_id\": \"7vmg6q36ak4b8kzr\",\n                \"referenced_content_id\": \"reloj65plp4v8ndy\",\n                \"created_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                },\n                \"updated_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                }\n            },\n            \"link\": {\n            \"object\": \"Link\",\n                \"id\": \"dqb9073ap3ekzgrm\",\n                \"link_url\": \"https://stackoverflow.com/questions/38726530/replace-snake-case-to-camelcase-in-part-of-a-string\",\n                \"content_id\": \"7vmg6q36ak4b8kzr\",\n                \"created_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                },\n                \"updated_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                }\n            }\n        }\n    },\n    \"meta\": {\n    \"include\": [],\n        \"custom\": []\n    }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "Content",
    "name": "deleteContent",
    "type": "DELETE",
    "url": "/v1/user/:id/content/:content_id",
    "title": "Delete Content",
    "description": "<p>Deletes the given Content</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated|Owner"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Content/UI/API/Routes/DeleteContent.v1.private.php",
    "groupTitle": "Content"
  },
  {
    "group": "Content",
    "name": "getAllContents",
    "type": "GET",
    "url": "/v1/content",
    "title": "Endpoint title here..",
    "description": "<p>Endpoint description here..</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "parameters",
            "description": "<p>here..</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  // Insert the response of the request here...\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Content/UI/API/Routes/GetAllContents.v1.private.php",
    "groupTitle": "Content"
  },
  {
    "group": "Content",
    "name": "getContent",
    "type": "GET",
    "url": "/v1/user/:id/content/:content_id",
    "title": "Get Content",
    "description": "<p>Find the content by its ID</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "filename": "app/Containers/Content/UI/API/Routes/GetContent.v1.private.php",
    "groupTitle": "Content",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n    \"object\": \"Content\",\n        \"id\": \"7vmg6q36ak4b8kzr\",\n        \"created_at\": {\n        \"date\": \"2019-01-04 05:17:42.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"Asia/Tehran\"\n        },\n        \"updated_at\": {\n        \"date\": \"2019-01-04 05:17:42.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"Asia/Tehran\"\n        },\n        \"deleted_at\": null,\n        \"add-on\": {\n        \"article\": {\n            \"object\": \"Article\",\n                \"id\": \"ojl0865y0j4bgmew\",\n                \"title\": \"شسیشسی\",\n                \"text\": \"این متن یک نوشته است\",\n                \"content_id\": \"7vmg6q36ak4b8kzr\",\n                \"created_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                },\n                \"updated_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                }\n            },\n            \"repost\": {\n            \"object\": \"Repost\",\n                \"id\": \"kxeml73oyx4d9qbr\",\n                \"content_id\": \"7vmg6q36ak4b8kzr\",\n                \"referenced_content_id\": \"reloj65plp4v8ndy\",\n                \"created_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                },\n                \"updated_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                }\n            },\n            \"link\": {\n            \"object\": \"Link\",\n                \"id\": \"dqb9073ap3ekzgrm\",\n                \"link_url\": \"https://stackoverflow.com/questions/38726530/replace-snake-case-to-camelcase-in-part-of-a-string\",\n                \"content_id\": \"7vmg6q36ak4b8kzr\",\n                \"created_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                },\n                \"updated_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                }\n            }\n        }\n    },\n    \"meta\": {\n    \"include\": [],\n        \"custom\": []\n    }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "Content",
    "name": "updateContent",
    "type": "PUT",
    "url": "/v1/user/:id/content/:content_id",
    "title": "Update Content",
    "description": "<p>Update Content</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated|Owner"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "array",
            "allowedValues": [
              "article",
              "repost",
              "link"
            ],
            "optional": true,
            "field": "addon",
            "description": "<p>example: addon[article =&gt; true, repost =&gt; true]</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": true,
            "field": "article",
            "description": "<p>article[title =&gt; title here, text =&gt; text here]</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": true,
            "field": "link",
            "description": "<p>link[link_url =&gt; https://stackoverflow.com/questions/38726530/replace-snake-case-to-camelcase-in-part-of-a-string]</p>"
          }
        ]
      }
    },
    "filename": "app/Containers/Content/UI/API/Routes/UpdateContent.v1.private.php",
    "groupTitle": "Content",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n    \"object\": \"Content\",\n        \"id\": \"7vmg6q36ak4b8kzr\",\n        \"created_at\": {\n        \"date\": \"2019-01-04 05:17:42.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"Asia/Tehran\"\n        },\n        \"updated_at\": {\n        \"date\": \"2019-01-04 05:17:42.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"Asia/Tehran\"\n        },\n        \"deleted_at\": null,\n        \"add-on\": {\n        \"article\": {\n            \"object\": \"Article\",\n                \"id\": \"ojl0865y0j4bgmew\",\n                \"title\": \"شسیشسی\",\n                \"text\": \"این متن یک نوشته است\",\n                \"content_id\": \"7vmg6q36ak4b8kzr\",\n                \"created_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                },\n                \"updated_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                }\n            },\n            \"repost\": {\n            \"object\": \"Repost\",\n                \"id\": \"kxeml73oyx4d9qbr\",\n                \"content_id\": \"7vmg6q36ak4b8kzr\",\n                \"referenced_content_id\": \"reloj65plp4v8ndy\",\n                \"created_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                },\n                \"updated_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                }\n            },\n            \"link\": {\n            \"object\": \"Link\",\n                \"id\": \"dqb9073ap3ekzgrm\",\n                \"link_url\": \"https://stackoverflow.com/questions/38726530/replace-snake-case-to-camelcase-in-part-of-a-string\",\n                \"content_id\": \"7vmg6q36ak4b8kzr\",\n                \"created_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                },\n                \"updated_at\": {\n                \"date\": \"2019-01-04 05:17:42.000000\",\n                    \"timezone_type\": 3,\n                    \"timezone\": \"Asia/Tehran\"\n                }\n            }\n        }\n    },\n    \"meta\": {\n    \"include\": [],\n        \"custom\": []\n    }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "Localization",
    "name": "getAllLocalizations",
    "type": "GET",
    "url": "/v1/localizations",
    "title": "Get all localizations",
    "description": "<p>Return all available localizations that are &quot;configured&quot; in the application</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "parameters",
            "description": "<p>here..</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  // TODO..\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Localization/UI/API/Routes/GetAllLocalizations.v1.private.php",
    "groupTitle": "Localization"
  },
  {
    "group": "OAuth2",
    "name": "ClientAdminWebAppLoginProxy",
    "type": "post",
    "url": "/v1/clients/web/admin/login",
    "title": "Login (Password Grant with proxy)",
    "description": "<p>Login Users using their email and password, without client_id and client_secret.</p>",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>user email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>user password</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"token_type\": \"Bearer\",\n  \"expires_in\": 315360000,\n  \"access_token\": \"eyJ0eXAiOiJKV1QiLCJhbG...\",\n  \"refresh_token\": \"ZFDPA1S7H8Wydjkjl+xt+hPGWTagX...\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Authentication/UI/API/Routes/ProxyLoginForAdminWebClient.v1.public.php",
    "groupTitle": "OAuth2"
  },
  {
    "group": "OAuth2",
    "name": "ClientAdminWebAppRefreshProxy",
    "type": "post",
    "url": "/v1/clients/web/admin/refresh",
    "title": "Refresh",
    "description": "<p>If <code>refresh_token</code> is not provided the w'll try to get it from the http cookie.</p>",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "refresh_token",
            "description": "<p>The refresh Token</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"token_type\": \"Bearer\",\n  \"expires_in\": 315360000,\n  \"access_token\": \"eyJ0eXAiOiJKV1QiLCJhbG...\",\n  \"refresh_token\": \"ZFDPA1S7H8Wydjkjl+xt+hPGWTagX...\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Authentication/UI/API/Routes/ProxyRefreshForAdminWebClient.v1.public.php",
    "groupTitle": "OAuth2"
  },
  {
    "group": "OAuth2",
    "name": "LoginCredentialsGrant",
    "type": "post",
    "url": "/v1/oauth/token",
    "title": "Login (Client Credentials Grant)",
    "description": "<p>Login Users using their username and passwords. (For Third-Party Clients). You must have client ID and secret first. You can generate them by creating new Client in our Web App.</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "client_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "client_secret",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "grant_type",
            "description": "<p>must be <code>client_credentials</code></p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "scope",
            "description": "<p>you can leave it empty</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"token_type\": \"Bearer\",\n  \"expires_in\": 315360000,\n  \"access_token\": \"eyJ0eXAiOiJKV1QiLCJhbG...\",\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Authentication/UI/API/Routes/LoginUsingCredentialGrant.v1.public.php",
    "groupTitle": "OAuth2"
  },
  {
    "group": "OAuth2",
    "name": "LoginPasswordGrant",
    "type": "post",
    "url": "/v1/oauth/token",
    "title": "Login (Password Grant)",
    "description": "<p>Login Users using their valid username and password. (For First-Party Clients)</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>user phone number or confirmed email address. example: <code>+989360000000</code></p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>pin-code which is sent to phone or email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "client_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "client_secret",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "grant_type",
            "description": "<p>must be <code>password</code></p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "scope",
            "description": "<p>you can leave it empty</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"token_type\": \"Bearer\",\n  \"expires_in\": 315360000,\n  \"access_token\": \"eyJ0eXAiOiJKV1QiLCJhbG...\",\n  \"refresh_token\": \"Oukd61zgKzt8TBwRjnasd...\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Authentication/UI/API/Routes/LoginUsingPasswordGrant.v1.private.php",
    "groupTitle": "OAuth2"
  },
  {
    "group": "OAuth2",
    "name": "Logout",
    "type": "DELETE",
    "url": "/v1/logout",
    "title": "",
    "description": "<p>User Logout. (Revoking Access Token)</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 202 Accepted\n{\n  \"message\": \"Token revoked successfully.\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Authentication/UI/API/Routes/Logout.v1.public.php",
    "groupTitle": "OAuth2"
  },
  {
    "group": "RolePermission",
    "name": "assignRoleToUser",
    "type": "post",
    "url": "/v1/roles/assign",
    "title": "Assign Roles to User",
    "description": "<p>Assign new roles to user. This endpoint does not sync the user with the new roles. It simply assign new role to the user. So make sure to never send an already assigned role since it will cause an error. To sync (update) all existing roles with the new ones use <code>/roles/sync</code> endpoint instead.</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>User ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "roles_ids",
            "description": "<p>Role ID or Array of Roles ID's</p>"
          }
        ]
      }
    },
    "filename": "app/Containers/Authorization/UI/API/Routes/AssignUserToRole.v1.private.php",
    "groupTitle": "RolePermission",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"object\": \"User\",\n        \"id\": \"lnmojg5bv4ew80ra\",\n        \"first_name\": null,\n        \"last_name\": null,\n        \"email\": null,\n        \"phone\": \"+989362913366\",\n        \"confirmed\": null,\n        \"gender\": null,\n        \"birth\": null,\n        \"points\": 0,\n        \"created_at\": {\n            \"date\": \"2018-10-25 10:18:30.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"UTC\"\n        },\n        \"updated_at\": {\n            \"date\": \"2018-10-26 16:38:13.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"UTC\"\n        },\n        \"readable_created_at\": \"1 day ago\",\n        \"readable_updated_at\": \"3 minutes ago\"\n        },\n        \"meta\": {\n            \"include\": [],\n            \"custom\": []\n    }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "RolePermission",
    "name": "attachPermissionToRole",
    "type": "post",
    "url": "/v1/permissions/attach",
    "title": "Attach Permissions to Role",
    "description": "<p>Attach new permissions to role. This endpoint does not sync the role with the new permissions. It simply attach new permission to the role. So make sure to never send an already attached permission since it will cause an error. To sync (update) all existing permissions with the new ones use <code>/permissions/sync</code> endpoint instead.</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "role_id",
            "description": "<p>Role ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "permissions_ids",
            "description": "<p>Permission ID or Array of Permissions ID's</p>"
          }
        ]
      }
    },
    "filename": "app/Containers/Authorization/UI/API/Routes/AttachPermissionToRole.v1.private.php",
    "groupTitle": "RolePermission",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n   \"data\":{\n      \"object\":\"Role\",\n      \"id\":\"eqwja3vw94kzmxr0\",\n      \"name\":\"praesentium-aut\",\n      \"description\":null,\n      \"display_name\":null,\n      \"permissions\":{\n         \"data\":[\n            {\n               \"object\":\"Permission\",\n               \"id\":\"n9kq6345javb05je\",\n               \"name\":\"est-sit-voluptatem\",\n               \"description\":null,\n               \"display_name\":null\n            },\n            {\n               \"object\":\"Permission\",\n               \"id\":\"999q6345javb05je\",\n               \"name\":\"something-else\",\n               \"description\":null,\n               \"display_name\":null\n            }\n         ]\n      }\n   },\n   \"meta\":{\n      \"include\":[\n\n      ],\n      \"custom\":[\n\n      ]\n   }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "RolePermission",
    "name": "createRole",
    "type": "post",
    "url": "/v1/roles",
    "title": "Create a Role",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Unique Role Name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "description",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "display_name",
            "description": ""
          }
        ]
      }
    },
    "filename": "app/Containers/Authorization/UI/API/Routes/CreateRole.v1.private.php",
    "groupTitle": "RolePermission",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n   \"data\":{\n      \"object\":\"Role\",\n      \"id\":\"eqwja3vw94kzmxr0\",\n      \"name\":\"praesentium-aut\",\n      \"description\":null,\n      \"display_name\":null,\n      \"permissions\":{\n         \"data\":[\n            {\n               \"object\":\"Permission\",\n               \"id\":\"n9kq6345javb05je\",\n               \"name\":\"est-sit-voluptatem\",\n               \"description\":null,\n               \"display_name\":null\n            },\n            {\n               \"object\":\"Permission\",\n               \"id\":\"999q6345javb05je\",\n               \"name\":\"something-else\",\n               \"description\":null,\n               \"display_name\":null\n            }\n         ]\n      }\n   },\n   \"meta\":{\n      \"include\":[\n\n      ],\n      \"custom\":[\n\n      ]\n   }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "RolePermission",
    "name": "deleteRole",
    "type": "delete",
    "url": "/v1/roles/:id",
    "title": "Delete a Role",
    "description": "<p>Delete Role by ID</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated Role"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 202 OK\n{\n    \"message\": \"Role (manager) Deleted Successfully.\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Authorization/UI/API/Routes/DeleteRole.v1.private.php",
    "groupTitle": "RolePermission"
  },
  {
    "group": "RolePermission",
    "name": "detachPermissionFromRole",
    "type": "post",
    "url": "/v1/permissions/detach",
    "title": "Detach Permissions from Role",
    "description": "<p>Detach existing permission from role. This endpoint does not sync the role It just detach the passed permissions from the role. So make sure to never send an non attached permission since it will cause an error. To sync (update) all existing permissions with the new ones use <code>/permissions/sync</code> endpoint instead.</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "role_id",
            "description": "<p>Role ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String-Array",
            "optional": false,
            "field": "permissions_ids",
            "description": "<p>Permission ID or Array of Permissions ID's</p>"
          }
        ]
      }
    },
    "filename": "app/Containers/Authorization/UI/API/Routes/DetachPermissionsFromRole.v1.private.php",
    "groupTitle": "RolePermission",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n   \"data\":{\n      \"object\":\"Role\",\n      \"id\":\"eqwja3vw94kzmxr0\",\n      \"name\":\"praesentium-aut\",\n      \"description\":null,\n      \"display_name\":null,\n      \"permissions\":{\n         \"data\":[\n            {\n               \"object\":\"Permission\",\n               \"id\":\"n9kq6345javb05je\",\n               \"name\":\"est-sit-voluptatem\",\n               \"description\":null,\n               \"display_name\":null\n            },\n            {\n               \"object\":\"Permission\",\n               \"id\":\"999q6345javb05je\",\n               \"name\":\"something-else\",\n               \"description\":null,\n               \"display_name\":null\n            }\n         ]\n      }\n   },\n   \"meta\":{\n      \"include\":[\n\n      ],\n      \"custom\":[\n\n      ]\n   }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "RolePermission",
    "name": "getAllPermissions",
    "type": "get",
    "url": "/v1/permissions",
    "title": "Get All Permission",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "filename": "app/Containers/Authorization/UI/API/Routes/GetAllPermissions.v1.private.php",
    "groupTitle": "RolePermission",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": [\n    {\n      // same object structure of the single response\n    },\n    {\n      // ...\n    },\n    // ...\n  ],\n  \"include\": [\n    \"xxx\",\n    \"yyy\",\n  ],\n  \"custom\": [],\n  \"meta\": {\n    \"pagination\": {\n      \"total\": x,\n      \"count\": x,\n      \"per_page\": x,\n      \"current_page\": x,\n      \"total_pages\": x,\n      \"links\": []\n    }\n  }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "RolePermission",
    "name": "getAllRoles",
    "type": "get",
    "url": "/v1/roles",
    "title": "Get All Roles",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "filename": "app/Containers/Authorization/UI/API/Routes/GetAllRoles.v1.private.php",
    "groupTitle": "RolePermission",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": [\n    {\n      // same object structure of the single response\n    },\n    {\n      // ...\n    },\n    // ...\n  ],\n  \"include\": [\n    \"xxx\",\n    \"yyy\",\n  ],\n  \"custom\": [],\n  \"meta\": {\n    \"pagination\": {\n      \"total\": x,\n      \"count\": x,\n      \"per_page\": x,\n      \"current_page\": x,\n      \"total_pages\": x,\n      \"links\": []\n    }\n  }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "RolePermission",
    "name": "getPermission",
    "type": "get",
    "url": "/v1/permissions/:id",
    "title": "Find a Permission by ID",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "filename": "app/Containers/Authorization/UI/API/Routes/FindPermission.v1.private.php",
    "groupTitle": "RolePermission",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n   \"data\":{\n      \"object\":\"Permission\",\n      \"id\":\"n9kq6345javb05je\",\n      \"name\":\"amet-ducimus\",\n      \"description\":null,\n      \"display_name\":null\n   },\n   \"meta\":{\n      \"include\":[\n\n      ],\n      \"custom\":[\n\n      ]\n   }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "RolePermission",
    "name": "getRole",
    "type": "get",
    "url": "/v1/roles/:id",
    "title": "Find a Role by ID",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "filename": "app/Containers/Authorization/UI/API/Routes/FindRole.v1.private.php",
    "groupTitle": "RolePermission",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n   \"data\":{\n      \"object\":\"Role\",\n      \"id\":\"eqwja3vw94kzmxr0\",\n      \"name\":\"praesentium-aut\",\n      \"description\":null,\n      \"display_name\":null,\n      \"permissions\":{\n         \"data\":[\n            {\n               \"object\":\"Permission\",\n               \"id\":\"n9kq6345javb05je\",\n               \"name\":\"est-sit-voluptatem\",\n               \"description\":null,\n               \"display_name\":null\n            },\n            {\n               \"object\":\"Permission\",\n               \"id\":\"999q6345javb05je\",\n               \"name\":\"something-else\",\n               \"description\":null,\n               \"display_name\":null\n            }\n         ]\n      }\n   },\n   \"meta\":{\n      \"include\":[\n\n      ],\n      \"custom\":[\n\n      ]\n   }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "RolePermission",
    "name": "revokeRoleFromUser",
    "type": "post",
    "url": "/v1/roles/revoke",
    "title": "Revoke/Remove Roles from User",
    "description": "<p>Revoke existing roles from user. This endpoint does not sync the user It just revoke the passed role from the user. So make sure to never send a non assigned role since it will cause an error. To sync (update) all existing roles with the new ones use <code>/roles/sync</code> endpoint instead.</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>user ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "roles_ids",
            "description": "<p>Role ID or Array of Role ID's</p>"
          }
        ]
      }
    },
    "filename": "app/Containers/Authorization/UI/API/Routes/RevokeUserFromRole.v1.private.php",
    "groupTitle": "RolePermission",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"object\": \"User\",\n        \"id\": \"lnmojg5bv4ew80ra\",\n        \"first_name\": null,\n        \"last_name\": null,\n        \"email\": null,\n        \"phone\": \"+989362913366\",\n        \"confirmed\": null,\n        \"gender\": null,\n        \"birth\": null,\n        \"points\": 0,\n        \"created_at\": {\n            \"date\": \"2018-10-25 10:18:30.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"UTC\"\n        },\n        \"updated_at\": {\n            \"date\": \"2018-10-26 16:38:13.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"UTC\"\n        },\n        \"readable_created_at\": \"1 day ago\",\n        \"readable_updated_at\": \"3 minutes ago\"\n        },\n        \"meta\": {\n            \"include\": [],\n            \"custom\": []\n    }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "RolePermission",
    "name": "syncPermissionOnRole",
    "type": "post",
    "url": "/v1/permissions/sync",
    "title": "Sync Permissions on Role",
    "description": "<p>You can use this endpoint instead of <code>permissions/attach</code> &amp; <code>permissions/detach</code>. The sync endpoint will override all existing role permissions with the new one sent to this endpoint.</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "role_id",
            "description": "<p>Role ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "permissions_ids",
            "description": "<p>Permission ID or Array of Permissions ID's</p>"
          }
        ]
      }
    },
    "filename": "app/Containers/Authorization/UI/API/Routes/SyncPermissionOnRole.v1.private.php",
    "groupTitle": "RolePermission",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n   \"data\":{\n      \"object\":\"Role\",\n      \"id\":\"eqwja3vw94kzmxr0\",\n      \"name\":\"praesentium-aut\",\n      \"description\":null,\n      \"display_name\":null,\n      \"permissions\":{\n         \"data\":[\n            {\n               \"object\":\"Permission\",\n               \"id\":\"n9kq6345javb05je\",\n               \"name\":\"est-sit-voluptatem\",\n               \"description\":null,\n               \"display_name\":null\n            },\n            {\n               \"object\":\"Permission\",\n               \"id\":\"999q6345javb05je\",\n               \"name\":\"something-else\",\n               \"description\":null,\n               \"display_name\":null\n            }\n         ]\n      }\n   },\n   \"meta\":{\n      \"include\":[\n\n      ],\n      \"custom\":[\n\n      ]\n   }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "RolePermission",
    "name": "syncUserRoles",
    "type": "post",
    "url": "/v1/roles/sync",
    "title": "Sync User Roles",
    "description": "<p>You can use this endpoint instead of <code>roles/assign</code> &amp; <code>roles/revoke</code>. The sync endpoint will override all existing user roles with the new one sent to this endpoint.</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>User ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "roles_ids",
            "description": "<p>Role ID or Array of Roles ID's</p>"
          }
        ]
      }
    },
    "filename": "app/Containers/Authorization/UI/API/Routes/SyncUserRoles.v1.private.php",
    "groupTitle": "RolePermission",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"object\": \"User\",\n        \"id\": \"lnmojg5bv4ew80ra\",\n        \"first_name\": null,\n        \"last_name\": null,\n        \"email\": null,\n        \"phone\": \"+989362913366\",\n        \"confirmed\": null,\n        \"gender\": null,\n        \"birth\": null,\n        \"points\": 0,\n        \"created_at\": {\n            \"date\": \"2018-10-25 10:18:30.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"UTC\"\n        },\n        \"updated_at\": {\n            \"date\": \"2018-10-26 16:38:13.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"UTC\"\n        },\n        \"readable_created_at\": \"1 day ago\",\n        \"readable_updated_at\": \"3 minutes ago\"\n        },\n        \"meta\": {\n            \"include\": [],\n            \"custom\": []\n    }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "Setting",
    "name": "getAllSettings",
    "type": "GET",
    "url": "/v1/settings",
    "title": "Get All Settings",
    "description": "<p>Get All settings for the application</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "parameters",
            "description": "<p>here..</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"object\": \"Setting\",\n            \"id\": \"damq35egme74k0xv\",\n            \"key\": \"foo\",\n            \"value\": \"bar\"\n        },\n        {\n            \"object\": \"Setting\",\n            \"id\": \"damq35egme74k0xv\",\n            \"key\": \"test\",\n            \"value\": \"456\"\n        },\n        {\n            \"object\": \"Setting\",\n            \"id\": \"damq35egme74k0xv\",\n            \"key\": \"logout\",\n            \"value\": \"false\"\n        }\n    ],\n    \"meta\": {\n\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Settings/UI/API/Routes/GetAllSettings.v1.private.php",
    "groupTitle": "Setting"
  },
  {
    "group": "Settings",
    "name": "createSetting",
    "type": "POST",
    "url": "/v1/settings",
    "title": "Create Setting",
    "description": "<p>Create a new setting for the application</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "parameters",
            "description": "<p>here..</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"object\": \"Setting\",\n        \"id\": \"aadfa72342sa\",\n        \"key\": \"hello\",\n        \"value\": \"world\"\n    },\n    \"meta\": {\n        \"include\": [],\n        \"custom\": []\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Settings/UI/API/Routes/CreateSetting.v1.private.php",
    "groupTitle": "Settings"
  },
  {
    "group": "Settings",
    "name": "deleteSetting",
    "type": "DELETE",
    "url": "/v1/settings/:id",
    "title": "Delete Setting",
    "description": "<p>Deletes a setting entry</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "parameters",
            "description": "<p>here..</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 OK\n{\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Settings/UI/API/Routes/DeleteSetting.v1.private.php",
    "groupTitle": "Settings"
  },
  {
    "group": "Settings",
    "name": "updateSetting",
    "type": "PATCH",
    "url": "/v1/settings/:id",
    "title": "Update Setting",
    "description": "<p>Updates a setting entry (both key / value)</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "parameters",
            "description": "<p>here..</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"object\": \"Setting\",\n        \"id\": \"aadfa72342sa\",\n        \"key\": \"foo\",\n        \"value\": \"bar\"\n    },\n    \"meta\": {\n        \"include\": [],\n        \"custom\": []\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Settings/UI/API/Routes/UpdateSetting.v1.private.php",
    "groupTitle": "Settings"
  },
  {
    "group": "Transaction",
    "name": "createTransaction",
    "type": "POST",
    "url": "/v1/transactions",
    "title": "Endpoint title here..",
    "description": "<p>Endpoint description here..</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "parameters",
            "description": "<p>here..</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  // Insert the response of the request here...\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Transaction/UI/API/Routes/CreateTransaction.v1.private.php",
    "groupTitle": "Transaction"
  },
  {
    "group": "Transaction",
    "name": "getAllTransactions",
    "type": "GET",
    "url": "/v1/transactions",
    "title": "Endpoint title here..",
    "description": "<p>Endpoint description here..</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "parameters",
            "description": "<p>here..</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  // Insert the response of the request here...\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/Transaction/UI/API/Routes/GetAllTransactions.v1.private.php",
    "groupTitle": "Transaction"
  },
  {
    "group": "Users",
    "name": "createAdmin",
    "type": "post",
    "url": "/v1/admin",
    "title": "Create Admin type Users",
    "description": "<p>Creating non client Users, form the Dashboard.</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": ""
          }
        ]
      }
    },
    "filename": "app/Containers/User/UI/API/Routes/CreateAdmin.v1.private.php",
    "groupTitle": "Users",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"object\": \"User\",\n        \"id\": \"lnmojg5bv4ew80ra\",\n        \"first_name\": null,\n        \"last_name\": null,\n        \"email\": null,\n        \"phone\": \"+989362913366\",\n        \"confirmed\": null,\n        \"gender\": null,\n        \"birth\": null,\n        \"points\": 0,\n        \"created_at\": {\n            \"date\": \"2018-10-25 10:18:30.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"UTC\"\n        },\n        \"updated_at\": {\n            \"date\": \"2018-10-26 16:38:13.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"UTC\"\n        },\n        \"readable_created_at\": \"1 day ago\",\n        \"readable_updated_at\": \"3 minutes ago\"\n        },\n        \"meta\": {\n            \"include\": [],\n            \"custom\": []\n    }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "Users",
    "name": "deleteUser",
    "type": "delete",
    "url": "/v1/user/:id",
    "title": "Delete User (admin, client..)",
    "description": "<p>Delete Users of any type (Admin, Client,...)</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 202 OK\n{\n    \"message\": \"User (4) Deleted Successfully.\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Containers/User/UI/API/Routes/DeleteUser.v1.private.php",
    "groupTitle": "Users"
  },
  {
    "group": "Users",
    "name": "findUserById",
    "type": "get",
    "url": "/v1/user/:id",
    "title": "Find User",
    "description": "<p>Find a user by its ID</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "filename": "app/Containers/User/UI/API/Routes/FindUserById.v1.private.php",
    "groupTitle": "Users",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"object\": \"User\",\n        \"id\": \"lnmojg5bv4ew80ra\",\n        \"first_name\": null,\n        \"last_name\": null,\n        \"email\": null,\n        \"phone\": \"+989362913366\",\n        \"confirmed\": null,\n        \"gender\": null,\n        \"birth\": null,\n        \"points\": 0,\n        \"created_at\": {\n            \"date\": \"2018-10-25 10:18:30.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"UTC\"\n        },\n        \"updated_at\": {\n            \"date\": \"2018-10-26 16:38:13.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"UTC\"\n        },\n        \"readable_created_at\": \"1 day ago\",\n        \"readable_updated_at\": \"3 minutes ago\"\n        },\n        \"meta\": {\n            \"include\": [],\n            \"custom\": []\n    }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "Users",
    "name": "getAllAdmins",
    "type": "get",
    "url": "/v1/admin",
    "title": "Get All Admin Users",
    "description": "<p>Get All Users where role <code>Admin</code>. You can search for Users by email, name and ID. Example: <code>?search=Mahmoud</code> or <code>?search=whatever@mail.com</code>. You can specify the field as follow <code>?search=email:whatever@mail.com</code> or <code>?search=id:20</code>. You can search by multiple fields as follow: <code>?search=name:Mahmoud&amp;email:whatever@mail.com</code>.</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated Admin"
      }
    ],
    "filename": "app/Containers/User/UI/API/Routes/GetAllAdmins.v1.private.php",
    "groupTitle": "Users",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": [\n    {\n      // same object structure of the single response\n    },\n    {\n      // ...\n    },\n    // ...\n  ],\n  \"include\": [\n    \"xxx\",\n    \"yyy\",\n  ],\n  \"custom\": [],\n  \"meta\": {\n    \"pagination\": {\n      \"total\": x,\n      \"count\": x,\n      \"per_page\": x,\n      \"current_page\": x,\n      \"total_pages\": x,\n      \"links\": []\n    }\n  }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "Users",
    "name": "getAllClients",
    "type": "get",
    "url": "/v1/client",
    "title": "Get All Client Users",
    "description": "<p>Get All Users where role <code>Client</code>. You can search for Users by email, name and ID. Example: <code>?search=Mahmoud</code> or <code>?search=whatever@mail.com</code>. You can specify the field as follow <code>?search=email:whatever@mail.com</code> or <code>?search=id:20</code>. You can search by multiple fields as follow: <code>?search=name:Mahmoud&amp;email:whatever@mail.com</code>.</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "filename": "app/Containers/User/UI/API/Routes/GetAllClients.v1.private.php",
    "groupTitle": "Users",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": [\n    {\n      // same object structure of the single response\n    },\n    {\n      // ...\n    },\n    // ...\n  ],\n  \"include\": [\n    \"xxx\",\n    \"yyy\",\n  ],\n  \"custom\": [],\n  \"meta\": {\n    \"pagination\": {\n      \"total\": x,\n      \"count\": x,\n      \"per_page\": x,\n      \"current_page\": x,\n      \"total_pages\": x,\n      \"links\": []\n    }\n  }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "Users",
    "name": "getAllUsers",
    "type": "get",
    "url": "/v1/user",
    "title": "Get All Users",
    "description": "<p>Get All Application Users (clients and admins). For all registered users &quot;Clients&quot; only you can use <code>/clients</code>. And for all &quot;Admins&quot; only you can use <code>/admins</code>.</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "filename": "app/Containers/User/UI/API/Routes/GetAllUsers.v1.private.php",
    "groupTitle": "Users",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": [\n    {\n      // same object structure of the single response\n    },\n    {\n      // ...\n    },\n    // ...\n  ],\n  \"include\": [\n    \"xxx\",\n    \"yyy\",\n  ],\n  \"custom\": [],\n  \"meta\": {\n    \"pagination\": {\n      \"total\": x,\n      \"count\": x,\n      \"per_page\": x,\n      \"current_page\": x,\n      \"total_pages\": x,\n      \"links\": []\n    }\n  }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "Users",
    "name": "getAuthenticatedUser",
    "type": "GET",
    "url": "/v1/profile",
    "title": "Find Logged in User data (Profile Information)",
    "description": "<p>Find the user details of the logged in user from its Token. (without specifying his ID)</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "filename": "app/Containers/User/UI/API/Routes/GetAuthenticatedUser.v1.private.php",
    "groupTitle": "Users",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"object\": \"User\",\n        \"id\": \"lnmojg5bv4ew80ra\",\n        \"first_name\": null,\n        \"last_name\": null,\n        \"email\": null,\n        \"phone\": \"+989362913366\",\n        \"confirmed\": null,\n        \"gender\": null,\n        \"birth\": null,\n        \"points\": 0,\n        \"created_at\": {\n            \"date\": \"2018-10-25 10:18:30.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"UTC\"\n        },\n        \"updated_at\": {\n            \"date\": \"2018-10-26 16:38:13.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"UTC\"\n        },\n        \"readable_created_at\": \"1 day ago\",\n        \"readable_updated_at\": \"3 minutes ago\"\n        },\n        \"meta\": {\n            \"include\": [],\n            \"custom\": []\n    }\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "Users",
    "name": "login",
    "type": "POST",
    "url": "/v1/login",
    "title": "Login user",
    "description": "<p>Login user using username and password</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": ""
          }
        ]
      }
    },
    "filename": "app/Containers/User/UI/API/Routes/Login.v1.private.php",
    "groupTitle": "Users",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content\n{\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "Users",
    "name": "register",
    "type": "post",
    "url": "/v1/register",
    "title": "Register User",
    "description": "<p>Create a user by phone or email and password or without password (one time password will be sent to user)</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": ""
          }
        ]
      }
    },
    "filename": "app/Containers/User/UI/API/Routes/Register.v1.private.php",
    "groupTitle": "Users",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content\n{\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "group": "Users",
    "name": "updateUser",
    "type": "put",
    "url": "/v1/user/:id",
    "title": "Update User",
    "version": "1.0.0",
    "permission": [
      {
        "name": "Authenticated User"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "first_name",
            "description": "<p>min:2|max:50</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "last_name",
            "description": "<p>min:2|max:50</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "nick_name",
            "description": "<p>min:2|max:50</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "email",
            "description": "<p>email|unique:users,email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "phone",
            "description": "<p>size:13|regex:/(+989)[0-9]/</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "\"male,female,unspecified\""
            ],
            "optional": true,
            "field": "gender",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "date",
            "optional": true,
            "field": "birth",
            "description": "<p>date_format:YmdHiT'</p>"
          },
          {
            "group": "Parameter",
            "type": "image",
            "optional": true,
            "field": "avatar",
            "description": ""
          }
        ]
      }
    },
    "filename": "app/Containers/User/UI/API/Routes/UpdateUser.v1.private.php",
    "groupTitle": "Users",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"object\": \"User\",\n        \"id\": \"lnmojg5bv4ew80ra\",\n        \"first_name\": null,\n        \"last_name\": null,\n        \"email\": null,\n        \"phone\": \"+989362913366\",\n        \"confirmed\": null,\n        \"gender\": null,\n        \"birth\": null,\n        \"points\": 0,\n        \"created_at\": {\n            \"date\": \"2018-10-25 10:18:30.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"UTC\"\n        },\n        \"updated_at\": {\n            \"date\": \"2018-10-26 16:38:13.000000\",\n            \"timezone_type\": 3,\n            \"timezone\": \"UTC\"\n        },\n        \"readable_created_at\": \"1 day ago\",\n        \"readable_updated_at\": \"3 minutes ago\"\n        },\n        \"meta\": {\n            \"include\": [],\n            \"custom\": []\n    }\n}",
          "type": "json"
        }
      ]
    }
  }
] });
