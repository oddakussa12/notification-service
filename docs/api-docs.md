Table of content
---

1. [Notification](#notification) 
    1. [Email notification](#email-notification) 
        - [Notification template](#notification-template)
        - [Email account](#email-account)
    2. [SMS notification](#sms-notification) 
        - [Language](#Language)
        - [Smsmessage](#Smsmessage)
    3. [Api Reference](#API Reference) 
        - [Send notification](#Send notification)
        - [Get user notifications](#Get user notifications)
        - [Mark notifications as read](#Mark notifications as read)
        - [Mark all notifications as read](#Mark all notifications as read)
---


# Notification Service Documentation

## 1.1 Email Notification

### Notification template

There are different types of email notifications that could be sent for a user to serve different purposes. Hence, you can define a template for a particular email notification via the `createNotificationTemplate` field from the graphql Mutation type. 

 Below is a list of parameters.

| Arguments | Required | Description |
| :------ | :-------- | :------ |
| name | Yes | Specify the name of the template |
| templateId | String / foreign key |  |
| data | Yes / foreign key | The field of study |
| description | Yes | The institution in which the field is taken |
| is_active | Yes/foreign key | references basedata educational_level | 
| email_account_id | Yes | the grade of the particular grade | 

### Email account

You can specify a mail server description that sends the emails for users. Check the below table for more detail on the parameters to specify.

| Arguments | Required | Description |
| :------ | :-------- | :------ |
| ACCOUNT_NAME | String | Specify the name of the template |
| MAIL_MAILER | String / foreign key |  |
| MAIL_HOST | String / foreign key | The field of study |
| MAIL_PORT | String | The institution in which the field is taken |
| MAIL_USERNAME | String/foreign key | references basedata |
| MAIL_PASSWORD | String/foreign key | references basedata |
| MAIL_ENCRYPTION | String | the grade of the particular grade | 
| MAIL_FROM_ADDRESS | String | the grade of the particular grade | 
| MAIL_FROM_NAME | String | the grade of the particular grade | 



## 1.2 SMS Notification

### Language

This table is required to store different messages in different languages. 
So messages will be sent on users prefered language.

| Arguments | Required | Description |
| :------ | :-------- | :------ |
| id | integer | Serve as primary key and auto incrementing value |
| smsmessage_id | Integer / foreign key | references smsmessage
| code | String | Language code (ex EN for english) |
| message | longText | This is the actual message sent to the user |

### Smsmessage

This table is required to store different message types. For example SMS message for
Welcome, Reset password or any thing like Happy new year messages. This model has many languages.

| Arguments | Required | Description |
| :------ | :-------- | :------ |
| id | integer | Serve as primary key and auto incrementing value |
| title | longText | Message title (like Happy new year message, Welcome message...)


## API Reference

#### Send notification

```http
  POST /api/sendNotification
```

All types of notifications (Email, SMS, Push and InApp) are sent using the above
endpoint.

So Below are the parameters that are required to hit this endpoint successfully.

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `Service_name` | `string` | **Required**. Name of service that is hitting the notification service |
| `users` | `Object` | **Required**. List of users id in an array called user_id under users object. These are the receivers of your notification. |
| `InApp` | `Object` | **Required only of InApp notifications**. If you want to send InApp notification you must inclue this object in your request. |
| `subject` | `String` | **Required for InApp notifications**. Body/actual message of your notification. |
| `body` | `lonText` | **Required for InApp and email notifications**. Subjec of your notification. |
| `is_for_all` | `boolean` | If ture, Your notification will be sent for all users. Default value is false. |
| `actions` | `array of object` | **Required for InApp notifications**. Actions are usually buttons to redirect user to certain uri.|
| `label` | `string` | **Required.**. Usally label of your anchor tag or button.|
| `url` | `string` | **Required**. This is the uri you want your user to redirect to.|
| `SMS` | `Object` | **Required for SMS notifications**. This object has other attributes like message_id and is_for_all, which you want to send.|
| `message_id` | `integer` | **Required for SMS notifications**. Id of SMS message you want to sent.|
| `email` | `object` | **Required for Email notifications**. This object hold other attributes neccesary to send email notifications.|
| `account_name` | `string` | **Required for Email notifications**. Specify which email account to use to send this email.|
| `template_id` | `string` | **Required for Email notifications**. Select the id of email template you want to use.|
| `data` | `object` | **Required for Email notifications**. This object contain different data like the name of the user who will receive this email or links in the email body.|
| `push` | `object` | **Required for push notifications**. Contain other objects and values for send push notifications.|


GENERAL POST REQUEST FOR SENDING NOTIFICATION LOOKS LIKE:

```bash
  {
    "service_name" : "Sender service",
    "users": {
        "user_id": ["825db509-2092-4631-a888-e09b2363db43","bb685665-7c66-4a45-8dcd-e604afc70825"]
    },
    "InAPP": {
        "subject" : "Brand new in-app notification",
        "body" : "This is the body of the in app notification", 
        "is_for_all" : "false", 
        "action" : [
            {
            "label" : "",
            "url"   : "https://localhost:8000/home"
            },
            {
            "label" : "Confirm login",
            "url"   : "https://localhost:8000/login"
            }
        ]
    },
    "SMS": {
        "message_id" : 1,
        "is_for_all" : "false"
    },
    "email": {
        "account_name" : "OTP-Email",
        "template_id": "OTP",
        "subject" : "Welcome to LMIS",
        "is_for_all":"false",
        "data": {
            "name": "Odda.k" 
        },
    },
    "push" : {
        "notification": {
            "title" : "Congratulations!",
            "body" : "Your profile is completed"
        },
        "is_for_all":"false"
    }
}
```

#### Get user notifications

```http
  GET /api/userNotification/{user_id}
```

This endpoint helps you to get users notification

#### Mark notifications as read

```http
  GET /api/markAsRead
```

This endpoint helps you to mark user notifications as read.

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `user_id` | `integer` | **Required**. User id |
| `notification_ids` | `array` | **Required**. Id of notifications you want to mark as read. |

```bash
{
    "user_id":2,
    "notification_ids":[
        "c92cff20-094f-4b9b-9c38-c4f9f5bf7a71",
        "5908d5be-bb08-4843-911c-454de2c70438",
        "6e24ee81-37cb-4a4d-860d-273e9499feb9"
    ]
}
```

#### Mark all notifications as read

```http
  GET /api/markAllAsRead
```

This endpoint helps you to mark all user notifications as read.

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `user_id` | `integer` | **Required**. User id |


```bash
{
    "user_id":2,
}
```


### Authors

- [@Odda Kussa](https://gitlab.com/Odda251)
- [@Gelila Hamid](https://gitlab.com/gelilahamid2)
