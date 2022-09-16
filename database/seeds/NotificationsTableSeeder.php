<?php


use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('notifications')->delete();

        \DB::table('notifications')->insert(array (
            0 =>
            array (
                'id' => '04756b19-1b10-4992-8d86-d246c0fbd185',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:38:10.000000Z","madh":"D5823e2","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:D5823e2 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:38:12',
                'updated_at' => '2020-08-07 18:38:12',
            ),
            1 =>
            array (
                'id' => '0c6ed3e3-62dc-4c39-9025-04f34da79c72',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:17:12.000000Z","madh":"5B415cf","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:5B415cf from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:24:44',
                'updated_at' => '2020-08-07 18:24:44',
            ),
            2 =>
            array (
                'id' => '12e74129-9020-492f-bc05-bbaa6bca20e0',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:26:31.000000Z","madh":"6Bbe607","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:6Bbe607 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:26:33',
                'updated_at' => '2020-08-07 18:26:33',
            ),
            3 =>
            array (
                'id' => '1399bf4e-2f91-41d8-be14-978520b1760d',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:50:36.000000Z","madh":"FD153ec","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:FD153ec from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:50:41',
                'updated_at' => '2020-08-07 18:50:41',
            ),
            4 =>
            array (
                'id' => '14bc3501-283f-49ab-b874-b9cfe1701d6d',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 115,
                'data' => '{"order_date":"2020-05-16T15:14:20.000000Z","madh":"2F8bcf4","user_id":"114","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:2F8bcf4 from user_id:114"}',
                'read_at' => NULL,
                'created_at' => '2020-05-16 08:14:25',
                'updated_at' => '2020-05-16 08:14:25',
            ),
            5 =>
            array (
                'id' => '1765da7d-fab1-4559-92c1-7660ec8737cd',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:33:19.000000Z","madh":"BF3aee5","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:BF3aee5 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:33:20',
                'updated_at' => '2020-08-07 18:33:20',
            ),
            6 =>
            array (
                'id' => '1965444f-72a2-499c-8fcf-9d2d82c4c969',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 115,
                'data' => '{"order_date":"2020-05-17T05:10:14.000000Z","madh":"B1c9f90","user_id":"116","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:B1c9f90 from user_id:116"}',
                'read_at' => NULL,
                'created_at' => '2020-05-16 22:10:20',
                'updated_at' => '2020-05-16 22:10:20',
            ),
            7 =>
            array (
                'id' => '204ff062-63da-45ea-8750-ea3fbade5d41',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-07-17T01:39:54.000000Z","madh":"39ca827","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:39ca827 from user_id:135"}',
                'read_at' => '2020-07-19 11:24:56',
                'created_at' => '2020-07-16 18:39:58',
                'updated_at' => '2020-07-19 11:24:56',
            ),
            8 =>
            array (
                'id' => '22966553-9ee6-4cd8-a768-f7cc0eda8e5e',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-05-19T03:30:18.000000Z","madh":"9Fa5675","user_id":"114","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:9Fa5675 from user_id:114"}',
                'read_at' => NULL,
                'created_at' => '2020-05-18 20:30:23',
                'updated_at' => '2020-05-18 20:30:23',
            ),
            9 =>
            array (
                'id' => '275dae09-676b-4d2c-8a7b-c0872a9663e1',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-05-18T08:14:21.000000Z","madh":"C9bc5c2","user_id":"114","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:C9bc5c2 from user_id:114"}',
                'read_at' => NULL,
                'created_at' => '2020-05-18 01:14:26',
                'updated_at' => '2020-05-18 01:14:26',
            ),
            10 =>
            array (
                'id' => '275fd4c9-47be-4a8f-ace6-488c3c0ebff6',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 115,
                'data' => '{"order_date":"2020-05-19T03:30:18.000000Z","madh":"9Fa5675","user_id":"114","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:9Fa5675 from user_id:114"}',
                'read_at' => NULL,
                'created_at' => '2020-05-18 20:30:24',
                'updated_at' => '2020-05-18 20:30:24',
            ),
            11 =>
            array (
                'id' => '2bb33302-7dce-4a4a-b17c-d1a38b625377',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:33:19.000000Z","madh":"BF3aee5","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:BF3aee5 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:33:20',
                'updated_at' => '2020-08-07 18:33:20',
            ),
            12 =>
            array (
                'id' => '2c5b707c-6cdd-4a8e-a17b-ab385e3256c5',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-07-17T02:57:08.000000Z","madh":"4F7ce58","user_id":"143","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:4F7ce58 from user_id:143"}',
                'read_at' => NULL,
                'created_at' => '2020-07-16 19:57:12',
                'updated_at' => '2020-07-16 19:57:12',
            ),
            13 =>
            array (
                'id' => '2d30d22b-a8a3-4deb-aaea-f7d3dd74f674',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-07-17T01:38:44.000000Z","madh":"79aec5c","user_id":"137","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:79aec5c from user_id:137"}',
                'read_at' => NULL,
                'created_at' => '2020-07-16 18:38:48',
                'updated_at' => '2020-07-16 18:38:48',
            ),
            14 =>
            array (
                'id' => '2eb4836d-309e-40de-94f1-675251b64efa',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-09-04T11:22:50.000000Z","madh":"C07d626","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:C07d626 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-09-04 04:29:54',
                'updated_at' => '2020-09-04 04:29:54',
            ),
            15 =>
            array (
                'id' => '3080d375-449c-4852-a42f-b023c043333a',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 115,
                'data' => '{"order_date":"2020-05-18T08:14:21.000000Z","madh":"C9bc5c2","user_id":"114","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:C9bc5c2 from user_id:114"}',
                'read_at' => NULL,
                'created_at' => '2020-05-18 01:14:26',
                'updated_at' => '2020-05-18 01:14:26',
            ),
            16 =>
            array (
                'id' => '31501781-0f0e-4644-acfe-42f8e8cf5436',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T02:08:22.000000Z","madh":"D2287bb","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:D2287bb from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 19:08:27',
                'updated_at' => '2020-08-07 19:08:27',
            ),
            17 =>
            array (
                'id' => '3174b0cc-d195-429e-b29e-d54413eb94cc',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-05-17T05:10:14.000000Z","madh":"B1c9f90","user_id":"116","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:B1c9f90 from user_id:116"}',
                'read_at' => '2020-05-16 22:12:33',
                'created_at' => '2020-05-16 22:10:19',
                'updated_at' => '2020-05-16 22:12:33',
            ),
            18 =>
            array (
                'id' => '33386316-c6c0-4382-a8eb-a6b5b652616d',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-09-04T11:21:25.000000Z","madh":"C58da28","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:C58da28 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-09-04 04:29:54',
                'updated_at' => '2020-09-04 04:29:54',
            ),
            19 =>
            array (
                'id' => '344d2938-070d-45bd-9b04-90289f0ba2e7',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-05-17T05:11:29.000000Z","madh":"99e1690","user_id":"116","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:99e1690 from user_id:116"}',
                'read_at' => '2020-05-16 22:11:38',
                'created_at' => '2020-05-16 22:11:33',
                'updated_at' => '2020-05-16 22:11:38',
            ),
            20 =>
            array (
                'id' => '36c0eafa-e7ae-4bfd-af0e-0259cf36432b',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-07-17T02:27:50.000000Z","madh":"99456da","user_id":"141","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:99456da from user_id:141"}',
                'read_at' => NULL,
                'created_at' => '2020-07-16 19:27:54',
                'updated_at' => '2020-07-16 19:27:54',
            ),
            21 =>
            array (
                'id' => '3708324b-5deb-4160-8d03-95cd3c1ca5eb',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:28:38.000000Z","madh":"A756a2c","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:A756a2c from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:29:46',
                'updated_at' => '2020-08-07 18:29:46',
            ),
            22 =>
            array (
                'id' => '3a8f60d1-fc76-4be2-8c6e-4d1cbfdc6e71',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 130,
                'data' => '{"order_date":"2020-05-31T16:16:45.000000Z","madh":"DBa2e5f","user_id":"1","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:DBa2e5f from user_id:1"}',
                'read_at' => NULL,
                'created_at' => '2020-05-31 09:16:50',
                'updated_at' => '2020-05-31 09:16:50',
            ),
            23 =>
            array (
                'id' => '3b9b4988-6fa8-4da7-9132-ee75a8153b74',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:50:36.000000Z","madh":"FD153ec","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:FD153ec from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:50:41',
                'updated_at' => '2020-08-07 18:50:41',
            ),
            24 =>
            array (
                'id' => '3c6f2f8f-cae1-475e-8c71-1a3d84b87f2a',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:51:01.000000Z","madh":"3E9e83b","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:3E9e83b from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:51:07',
                'updated_at' => '2020-08-07 18:51:07',
            ),
            25 =>
            array (
                'id' => '3d01a137-f448-45f7-aea0-c9e3e0c36991',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-09-04T11:22:50.000000Z","madh":"C07d626","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:C07d626 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-09-04 04:29:54',
                'updated_at' => '2020-09-04 04:29:54',
            ),
            26 =>
            array (
                'id' => '43ec2d58-0f3e-439f-af68-2763597d7a4d',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:44:41.000000Z","madh":"6B041c4","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:6B041c4 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:44:43',
                'updated_at' => '2020-08-07 18:44:43',
            ),
            27 =>
            array (
                'id' => '47d7d512-88b9-4346-bd2f-bca1365806de',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 138,
                'data' => '{"order_date":"2020-07-17T01:38:44.000000Z","madh":"79aec5c","user_id":"137","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:79aec5c from user_id:137"}',
                'read_at' => NULL,
                'created_at' => '2020-07-16 18:38:48',
                'updated_at' => '2020-07-16 18:38:48',
            ),
            28 =>
            array (
                'id' => '4a42b707-2845-4153-8012-7a6ded24ddfb',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 138,
                'data' => '{"order_date":"2020-07-17T00:59:28.000000Z","madh":"A622b9f","user_id":"137","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:A622b9f from user_id:137"}',
                'read_at' => NULL,
                'created_at' => '2020-07-16 17:59:33',
                'updated_at' => '2020-07-16 17:59:33',
            ),
            29 =>
            array (
                'id' => '4ba51eba-75ba-436a-bbeb-20f0682ee5e8',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T02:08:52.000000Z","madh":"B420b11","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:B420b11 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 19:08:56',
                'updated_at' => '2020-08-07 19:08:56',
            ),
            30 =>
            array (
                'id' => '503a08c4-de42-474a-9502-c3849b0f731a',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:38:10.000000Z","madh":"D5823e2","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:D5823e2 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:38:12',
                'updated_at' => '2020-08-07 18:38:12',
            ),
            31 =>
            array (
                'id' => '52a9c51f-e151-4bd3-afd0-58689afa8196',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-07-19T18:26:17.000000Z","madh":"8De530a","user_id":"137","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:8De530a from user_id:137"}',
                'read_at' => '2020-07-19 11:26:45',
                'created_at' => '2020-07-19 11:26:21',
                'updated_at' => '2020-07-19 11:26:45',
            ),
            32 =>
            array (
                'id' => '53b4c64e-ab50-4cd5-9921-128282b0fed2',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 130,
                'data' => '{"order_date":"2020-05-18T08:14:21.000000Z","madh":"C9bc5c2","user_id":"114","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:C9bc5c2 from user_id:114"}',
                'read_at' => NULL,
                'created_at' => '2020-05-18 01:14:26',
                'updated_at' => '2020-05-18 01:14:26',
            ),
            33 =>
            array (
                'id' => '5db5b1d8-f5a2-4c65-92dd-fea978f426a6',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:27:09.000000Z","madh":"60c418f","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:60c418f from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:27:09',
                'updated_at' => '2020-08-07 18:27:09',
            ),
            34 =>
            array (
                'id' => '60aa3241-e161-4b67-a943-bada35fe6003',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-07-19T18:26:17.000000Z","madh":"8De530a","user_id":"137","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:8De530a from user_id:137"}',
                'read_at' => NULL,
                'created_at' => '2020-07-19 11:26:21',
                'updated_at' => '2020-07-19 11:26:21',
            ),
            35 =>
            array (
                'id' => '6633baf4-edb9-46e6-beff-c87b738eda01',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:36:50.000000Z","madh":"617bc1c","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:617bc1c from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:36:50',
                'updated_at' => '2020-08-07 18:36:50',
            ),
            36 =>
            array (
                'id' => '69afba64-7d3a-4fd9-b368-47b70aa8408f',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:23:43.000000Z","madh":"935e908","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:935e908 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:24:44',
                'updated_at' => '2020-08-07 18:24:44',
            ),
            37 =>
            array (
                'id' => '6c533cd0-3fbd-4a1d-93e4-d639a83d2983',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:23:43.000000Z","madh":"935e908","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:935e908 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:24:44',
                'updated_at' => '2020-08-07 18:24:44',
            ),
            38 =>
            array (
                'id' => '71dd929f-f981-41fd-9993-50f07d494007',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 130,
                'data' => '{"order_date":"2020-05-21T17:00:05.000000Z","madh":"6133499","user_id":"115","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:6133499 from user_id:115"}',
                'read_at' => NULL,
                'created_at' => '2020-05-21 10:00:13',
                'updated_at' => '2020-05-21 10:00:13',
            ),
            39 =>
            array (
                'id' => '79e06ee5-d893-4b92-b13b-d46a24ed13fa',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:17:12.000000Z","madh":"5B415cf","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:5B415cf from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:24:44',
                'updated_at' => '2020-08-07 18:24:44',
            ),
            40 =>
            array (
                'id' => '7acdc3e0-30a3-48b4-b85a-fb193bd2e780',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 115,
                'data' => '{"order_date":"2020-05-17T05:04:44.000000Z","madh":"D5862de","user_id":"116","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:D5862de from user_id:116"}',
                'read_at' => NULL,
                'created_at' => '2020-05-16 22:04:51',
                'updated_at' => '2020-05-16 22:04:51',
            ),
            41 =>
            array (
                'id' => '7ade03d0-dceb-465d-a8cc-470b417fcac7',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 115,
                'data' => '{"order_date":"2020-05-18T08:13:47.000000Z","madh":"34cb9ac","user_id":"114","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:34cb9ac from user_id:114"}',
                'read_at' => NULL,
                'created_at' => '2020-05-18 01:13:52',
                'updated_at' => '2020-05-18 01:13:52',
            ),
            42 =>
            array (
                'id' => '7dce8fbd-e376-4d99-9e68-ee7a6970cb18',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-07-17T01:38:44.000000Z","madh":"79aec5c","user_id":"137","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:79aec5c from user_id:137"}',
                'read_at' => NULL,
                'created_at' => '2020-07-16 18:38:48',
                'updated_at' => '2020-07-16 18:38:48',
            ),
            43 =>
            array (
                'id' => '7e272d5d-f40f-48f9-bbf3-869e4769cf9a',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-07-17T00:59:28.000000Z","madh":"A622b9f","user_id":"137","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:A622b9f from user_id:137"}',
                'read_at' => NULL,
                'created_at' => '2020-07-16 17:59:33',
                'updated_at' => '2020-07-16 17:59:33',
            ),
            44 =>
            array (
                'id' => '818af43f-ed6f-448e-b4b4-b1cb938b4bbe',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-07-20T00:57:23.000000Z","madh":"3A7fa6a","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:3A7fa6a from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-07-19 17:57:28',
                'updated_at' => '2020-07-19 17:57:28',
            ),
            45 =>
            array (
                'id' => '85ae095f-dc8c-4db1-883b-c35b16cd80a7',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-09-04T11:30:22.000000Z","madh":"EA12751","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:EA12751 from user_id:135"}',
                'read_at' => '2020-09-04 04:30:49',
                'created_at' => '2020-09-04 04:30:27',
                'updated_at' => '2020-09-04 04:30:49',
            ),
            46 =>
            array (
                'id' => '8fda64db-8724-46a2-94d7-55a57be9332d',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:28:38.000000Z","madh":"A756a2c","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:A756a2c from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:29:46',
                'updated_at' => '2020-08-07 18:29:46',
            ),
            47 =>
            array (
                'id' => '910fcf27-aa8c-4814-84e7-3b972b97693d',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:26:31.000000Z","madh":"6Bbe607","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:6Bbe607 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:26:33',
                'updated_at' => '2020-08-07 18:26:33',
            ),
            48 =>
            array (
                'id' => '91e50dbf-8a65-4f2e-8eca-48719f1a5e00',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 115,
                'data' => '{"order_date":"2020-05-16T15:13:11.000000Z","madh":"B686bd6","user_id":"114","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:B686bd6 from user_id:114"}',
                'read_at' => NULL,
                'created_at' => '2020-05-16 08:14:14',
                'updated_at' => '2020-05-16 08:14:14',
            ),
            49 =>
            array (
                'id' => '98da1d53-107b-417e-ad4d-bf547c1b17e2',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:46:24.000000Z","madh":"73f23ae","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:73f23ae from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:46:26',
                'updated_at' => '2020-08-07 18:46:26',
            ),
            50 =>
            array (
                'id' => '9d03ce80-3118-4c12-948b-9a2e1bcd86e3',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-09-04T11:21:25.000000Z","madh":"C58da28","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:C58da28 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-09-04 04:29:53',
                'updated_at' => '2020-09-04 04:29:53',
            ),
            51 =>
            array (
                'id' => '9e453442-0c1a-4f27-9f82-f88ac70052c0',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-07-20T00:57:23.000000Z","madh":"3A7fa6a","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:3A7fa6a from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-07-19 17:57:29',
                'updated_at' => '2020-07-19 17:57:29',
            ),
            52 =>
            array (
                'id' => '9f855441-794d-4ca7-ad43-f6c37fedf24e',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 138,
                'data' => '{"order_date":"2020-07-17T01:39:54.000000Z","madh":"39ca827","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:39ca827 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-07-16 18:39:58',
                'updated_at' => '2020-07-16 18:39:58',
            ),
            53 =>
            array (
                'id' => '9fe8e342-e8b6-4c00-a4b0-63cbb3624260',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:36:50.000000Z","madh":"617bc1c","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:617bc1c from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:36:50',
                'updated_at' => '2020-08-07 18:36:50',
            ),
            54 =>
            array (
                'id' => 'a00e28f8-2927-4ebf-baa4-becb2db8a679',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:46:24.000000Z","madh":"73f23ae","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:73f23ae from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:46:26',
                'updated_at' => '2020-08-07 18:46:26',
            ),
            55 =>
            array (
                'id' => 'a16d13c4-2953-4cda-bf8b-9528f50cb880',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-07-17T02:57:08.000000Z","madh":"4F7ce58","user_id":"143","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:4F7ce58 from user_id:143"}',
                'read_at' => NULL,
                'created_at' => '2020-07-16 19:57:11',
                'updated_at' => '2020-07-16 19:57:11',
            ),
            56 =>
            array (
                'id' => 'a256e24d-c9d8-4c28-9275-70d4af17f67b',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:17:59.000000Z","madh":"08559e6","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:08559e6 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:24:44',
                'updated_at' => '2020-08-07 18:24:44',
            ),
            57 =>
            array (
                'id' => 'aa713c25-4247-45b9-9cbb-a0a2235e757d',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:51:01.000000Z","madh":"3E9e83b","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:3E9e83b from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:51:07',
                'updated_at' => '2020-08-07 18:51:07',
            ),
            58 =>
            array (
                'id' => 'aeebf356-2131-480a-b502-ab04d802eddd',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:44:41.000000Z","madh":"6B041c4","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:6B041c4 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:44:43',
                'updated_at' => '2020-08-07 18:44:43',
            ),
            59 =>
            array (
                'id' => 'b76c11f6-48e0-4125-9630-8fb23cf3ef6d',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-05-17T05:04:44.000000Z","madh":"D5862de","user_id":"116","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:D5862de from user_id:116"}',
                'read_at' => '2020-05-16 22:05:10',
                'created_at' => '2020-05-16 22:04:49',
                'updated_at' => '2020-05-16 22:05:10',
            ),
            60 =>
            array (
                'id' => 'b7a44446-edb7-4fe3-a63c-a9556a69401a',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-05-18T08:13:47.000000Z","madh":"34cb9ac","user_id":"114","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:34cb9ac from user_id:114"}',
                'read_at' => NULL,
                'created_at' => '2020-05-18 01:13:52',
                'updated_at' => '2020-05-18 01:13:52',
            ),
            61 =>
            array (
                'id' => 'b9e959b7-1588-4bed-b077-6b85c7eb9d8b',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:27:09.000000Z","madh":"60c418f","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:60c418f from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:27:09',
                'updated_at' => '2020-08-07 18:27:09',
            ),
            62 =>
            array (
                'id' => 'ba0baaab-c95b-4e9c-98a8-b3d233d1aa5b',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-07-17T00:59:28.000000Z","madh":"A622b9f","user_id":"137","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:A622b9f from user_id:137"}',
                'read_at' => NULL,
                'created_at' => '2020-07-16 17:59:33',
                'updated_at' => '2020-07-16 17:59:33',
            ),
            63 =>
            array (
                'id' => 'bd494098-b9a5-4542-a1f9-e90d3ec015fe',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:37:20.000000Z","madh":"E78f041","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:E78f041 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:37:21',
                'updated_at' => '2020-08-07 18:37:21',
            ),
            64 =>
            array (
                'id' => 'c1108685-5ab1-4444-b7de-ea76e77c3d1d',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-07-17T01:39:54.000000Z","madh":"39ca827","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:39ca827 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-07-16 18:39:57',
                'updated_at' => '2020-07-16 18:39:57',
            ),
            65 =>
            array (
                'id' => 'c5c8e6a9-6f26-4afa-94b6-0ebf2789f40d',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 130,
                'data' => '{"order_date":"2020-05-19T03:30:18.000000Z","madh":"9Fa5675","user_id":"114","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:9Fa5675 from user_id:114"}',
                'read_at' => NULL,
                'created_at' => '2020-05-18 20:30:24',
                'updated_at' => '2020-05-18 20:30:24',
            ),
            66 =>
            array (
                'id' => 'c8ed65c6-08f1-4744-83a7-469c4cc28eea',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:40:00.000000Z","madh":"6F1a350","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:6F1a350 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:40:04',
                'updated_at' => '2020-08-07 18:40:04',
            ),
            67 =>
            array (
                'id' => 'cda07af6-046d-429a-bb23-88157ee17595',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-09-04T11:30:22.000000Z","madh":"EA12751","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:EA12751 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-09-04 04:30:27',
                'updated_at' => '2020-09-04 04:30:27',
            ),
            68 =>
            array (
                'id' => 'cdce31f5-f8a3-4423-8940-b11e969aa9e1',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-07-17T02:56:00.000000Z","madh":"A89f5bf","user_id":"143","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:A89f5bf from user_id:143"}',
                'read_at' => '2020-07-19 11:25:00',
                'created_at' => '2020-07-16 19:56:04',
                'updated_at' => '2020-07-19 11:25:00',
            ),
            69 =>
            array (
                'id' => 'd05ac630-de63-4c56-986c-df931ff43f43',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:37:20.000000Z","madh":"E78f041","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:E78f041 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:37:21',
                'updated_at' => '2020-08-07 18:37:21',
            ),
            70 =>
            array (
                'id' => 'd6a2ccd0-d9c1-48ed-b17f-c7e32d07364e',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 130,
                'data' => '{"order_date":"2020-05-18T08:13:47.000000Z","madh":"34cb9ac","user_id":"114","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:34cb9ac from user_id:114"}',
                'read_at' => NULL,
                'created_at' => '2020-05-18 01:13:52',
                'updated_at' => '2020-05-18 01:13:52',
            ),
            71 =>
            array (
                'id' => 'db680be5-7e71-4658-83bf-1913db61cb9b',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 115,
                'data' => '{"order_date":"2020-05-17T05:11:29.000000Z","madh":"99e1690","user_id":"116","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:99e1690 from user_id:116"}',
                'read_at' => NULL,
                'created_at' => '2020-05-16 22:11:33',
                'updated_at' => '2020-05-16 22:11:33',
            ),
            72 =>
            array (
                'id' => 'dcf0e96f-af2f-4546-909b-4b4b0d8cbf1a',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:40:00.000000Z","madh":"6F1a350","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:6F1a350 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:40:04',
                'updated_at' => '2020-08-07 18:40:04',
            ),
            73 =>
            array (
                'id' => 'de3d3290-acbf-4194-9c97-1b074cbaaaba',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 115,
                'data' => '{"order_date":"2020-05-31T16:16:45.000000Z","madh":"DBa2e5f","user_id":"1","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:DBa2e5f from user_id:1"}',
                'read_at' => NULL,
                'created_at' => '2020-05-31 09:16:51',
                'updated_at' => '2020-05-31 09:16:51',
            ),
            74 =>
            array (
                'id' => 'e22e9727-4dec-4fb5-a5f4-7fdb36056e01',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T02:08:52.000000Z","madh":"B420b11","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:B420b11 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 19:08:56',
                'updated_at' => '2020-08-07 19:08:56',
            ),
            75 =>
            array (
                'id' => 'e413a058-2375-4304-8a32-b9d4618c9042',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:17:59.000000Z","madh":"08559e6","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:08559e6 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:24:44',
                'updated_at' => '2020-08-07 18:24:44',
            ),
            76 =>
            array (
                'id' => 'e4cff141-6a46-474b-ab65-170231eb321a',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T02:08:22.000000Z","madh":"D2287bb","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:D2287bb from user_id:135"}',
                'read_at' => '2020-08-08 02:08:08',
                'created_at' => '2020-08-07 19:08:27',
                'updated_at' => '2020-08-08 02:08:08',
            ),
            77 =>
            array (
                'id' => 'e8dcb3ed-6690-4099-8b0a-b80a3ee1c8d7',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-07-17T02:27:50.000000Z","madh":"99456da","user_id":"141","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:99456da from user_id:141"}',
                'read_at' => NULL,
                'created_at' => '2020-07-16 19:27:53',
                'updated_at' => '2020-07-16 19:27:53',
            ),
            78 =>
            array (
                'id' => 'e9868d0c-543a-4e05-ae2b-8f06ac218993',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 137,
                'data' => '{"order_date":"2020-08-08T01:48:20.000000Z","madh":"AA6c298","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:AA6c298 from user_id:135"}',
                'read_at' => NULL,
                'created_at' => '2020-08-07 18:48:21',
                'updated_at' => '2020-08-07 18:48:21',
            ),
            79 =>
            array (
                'id' => 'ecfd0be1-3b37-4dbc-8398-bd865c84ab0e',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-05-21T17:00:05.000000Z","madh":"6133499","user_id":"115","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:6133499 from user_id:115"}',
                'read_at' => '2020-05-31 02:21:48',
                'created_at' => '2020-05-21 10:00:12',
                'updated_at' => '2020-05-31 02:21:48',
            ),
            80 =>
            array (
                'id' => 'f9b91fae-7433-4462-bee8-b254b5965a20',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-05-31T16:16:45.000000Z","madh":"DBa2e5f","user_id":"1","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:DBa2e5f from user_id:1"}',
                'read_at' => NULL,
                'created_at' => '2020-05-31 09:16:50',
                'updated_at' => '2020-05-31 09:16:50',
            ),
            81 =>
            array (
                'id' => 'fab42a07-c8a9-4426-bc49-a7af3ef2c808',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-08-08T01:48:20.000000Z","madh":"AA6c298","user_id":"135","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:AA6c298 from user_id:135"}',
                'read_at' => '2020-08-08 02:12:41',
                'created_at' => '2020-08-07 18:48:21',
                'updated_at' => '2020-08-08 02:12:41',
            ),
            82 =>
            array (
                'id' => 'fc7d1b16-1013-47ef-bd76-3aabd58ccdc7',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 115,
                'data' => '{"order_date":"2020-05-21T17:00:05.000000Z","madh":"6133499","user_id":"115","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:6133499 from user_id:115"}',
                'read_at' => NULL,
                'created_at' => '2020-05-21 10:00:12',
                'updated_at' => '2020-05-21 10:00:12',
            ),
            83 =>
            array (
                'id' => 'fdd9e1e5-7930-427e-b3f3-5572ed7c91b2',
                'type' => 'App\\Notifications\\OrderSuccessNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"order_date":"2020-07-17T02:56:00.000000Z","madh":"A89f5bf","user_id":"143","payment_id":1,"required_date":null,"ship_date":null,"message":"A new order OrderCode:A89f5bf from user_id:143"}',
                'read_at' => NULL,
                'created_at' => '2020-07-16 19:56:04',
                'updated_at' => '2020-07-16 19:56:04',
            ),
        ));


    }
}
