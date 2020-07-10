<?php
    namespace app\common\services\user;

    use app\common\model\Users;
    use app\common\model\UserNames;
    use app\common\model\UserPasswords;
    use app\common\model\UserPhone;

    class UserBase
    {
        /*
         * 创建用户状态
         * @param   $user_status
         * @return  $user_id
         */
        public function createUser($user_status)
        {
            $data = [
                'user_status'   =>  $user_status,
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s'),
            ];
            $user_model = new Users();
            return $user_model->insertGetId($data);

        }

        /*
         * 更改用户状态
         * @param   $user
         */
        public function updateUserStatus($user)
        {
            $where = [
                'user_id'   =>  $user['user_id']
            ];
            $data = [
                'user_status'   =>  $user['user_status'],
                'updated_at'    =>  date('Y-m-d H:i:s'),
            ];
            $user_model = new Users();
            return $user_model->where($where)->update($data);
        }

        /*
         * 删除用户
         * @param   $user_id
         */
        public function deleteUserStatus($user_id)
        {
            $where = [
                'user_id'   =>  $user_id
            ];
            $user_model = new Users();
            return $user_model->where($where)->delete();
        }

        /*
         * 创建用户名
         * @param   $user
         */
        public function createUserName($user)
        {
            $data = [
                'user_id'   =>  $user['user_id'],
                'user_name' =>  $user['user_name'],
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s'),
            ];
            $user_name_model = new UserNames();
            return $user_name_model->data($data)->save();
        }

        /*
         * 更改用户名
         * @param   $user
         */
        public function updateUserName($user)
        {
            $where = [
                'user_id'   =>  $user['user_id']
            ];
            $data = [
                'user_name' =>  $user['user_name'],
                'updated_at'=>  date('Y-m-d H:i:s'),
            ];

            $user_name_model = new UserNames();
            return $user_name_model->where($where)->update($data);
        }

        /*
         * 删除用户名
         * @param   $user_id
         */
        public function deleteUserName($user_id)
        {
            $where = [
                'user_id'   =>  $user_id
            ];
            $user_name_model = new UserNames();
            return $user_name_model->where($where)->delete();
        }

        /*
         * 创建用户密码
         * @param   $user
         */
        public function createUserPassword($user)
        {
            $data = [
                'user_id'   =>  $user['user_id'],
                'password'  =>  $user['password'],
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s'),
            ];
            $user_password_model = new UserPasswords();
            return $user_password_model->data($data)->save();
        }

        /*
         * 获取用户密码
         * @param   $user_id
         * @return
         */
        public function getUserPasswordByUserId($user_id)
        {
            $where = [
                'user_id'   =>  $user_id
            ];
            $user_passwprd_model = new UserPasswords();
            $rt = $user_passwprd_model->where($where)->field('password')->find();
            return $rt ? $rt->password : false;
        }

        /*
         * 更新用户密码
         * @param   $user
         */
        public function updataUserPassword($user)
        {
            $where = [
                'user_id'   =>  $user['user_id']
            ];
            $data = [
                'password'  =>  $user['password'],
                'updated_at'=>  date('Y-m-d H:i:s')
            ];
            $user_password_model = new UserPasswords();
            return $user_password_model->where($where)->update($data);
        }

        /*
         * 删除用户密码
         * @param   $user_id
         */
        public function deleteUserPassword($user_id)
        {
            $where = [
                'user_id'   =>  $user_id
            ];
            $user_password_model = new UserPasswords();
            return $user_password_model->where($where)->delete();
        }

        /*
         * 创建用户手机号
         * @param   $user
         */
        public function createUserPhone($user)
        {
            $data = [
                'user_id'   =>  $user['user_id'],
                'phone'  =>  $user['phone'],
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s'),
            ];
            $user_phone_model = new UserPhone();
            return $user_phone_model->data($data)->save();
        }

        /*
         * 更新用户手机号
         * @param   $user
         */
        public function updateUserPhone($user)
        {
            $where = [
                'user_id'   =>  $user['user_id']
            ];
            $data = [
                'phone'  =>  $user['phone'],
                'updated_at'=>  date('Y-m-d H:i:s')
            ];
            $user_phone_moel = new UserPhone();
            return $user_phone_moel->where($where)->update($data);
        }

        /*
         * 删除用户手机号
         * @param   $user_id
         */
        public function deleteUserPhone($user_id)
        {
            $where = [
                'user_id'   =>  $user_id
            ];
            $user_phone_model = new UserPhone();
            return $user_phone_model->where($where)->delete();
        }

        /*
         * 获取用户名
         * @param   $user_id
         * @return
         */
        public function getUserNameByUserId($user_id)
        {
            $where = [
                'user_id' =>  $user_id
            ];
            $user_name_model = new UserNames();
            $rt = $user_name_model->where($where)->field('user_name')->find();
            return $rt ? $rt->user_name : false;
        }

        /*
         * 获取用户电话
         * @param   $user_id
         * @return
         */
        public function getPhoneByUserId($user_id)
        {
            $where = [
                'user_id' =>  $user_id
            ];
            $user_phone_moel = new UserPhone();
            $rt = $user_phone_moel->where($where)->field('phone')->find();
            return $rt ? $rt->phone : false;
        }


    }
?>