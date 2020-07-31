<?php namespace app\common\services\user;

    use app\common\model\UserNames;
    use app\common\model\Users;
    use think\Db;

    class UserBaseService extends UserBase
    {
        /*
         * 登陆验证
         * @param   $password $user_id
         */
        public function checkPassword($password,$user_id)
        {
            $pwd = $this->getUserPasswordByUserId($user_id);
            if($pwd != md5($password)){
                return false;
            }
            return true;
        }
        /*
         * 用户列表
         */
        public function paginate($where = [])
        {
            $order = 'created_at asc';
            $user_name_model = new UserNames();
            $lists = $user_name_model->where($where)->order($order)->paginate(10);
            foreach ($lists as $key => $list) {
                $user_status = $this->getUserStatusByUserId($list->user_id);
                $lists[$key]->status = $user_status;
            }

            return $lists;
        }

        /*
         * 获取用户状态
         * @param   $user_id
         * @return  $status
         */
        public function getUserStatusByUserId($user_id)
        {
            $where = [
                'user_id'   =>  $user_id
            ];
            $user_model = new Users();
            $rt = $user_model->where($where)->field('user_status')->find();
            return $rt ? $rt->user_status : false;
        }

        /*
         * 查询userId by $user_name
         * @param   $user_name
         * @return  $user_id
         */
        public function getUserIdByUserName($user_name)
        {
            $where = [
                'user_name' =>  $user_name
            ];
            $user_name_model = new UserNames();
            $rt = $user_name_model->where($where)->field('user_id')->find();
            return $rt ? $rt->user_id : false;
        }

        /*
         * 创建用户信息
         * @param   $user|array
         */
        public function createUserInformation($user)
        {
            $user['status'] = 1;
            if (!isset($user['user_name']) || !isset($user['password']) || !isset($user['phone'])) {
                return false;
            }
            Db::startTrans();
            try{
                $user_id = $this->createUser($user['status']);
                if($user_id){
                    $user['user_id'] = $user_id;
                    $this->createUserName($user);
                    $this->createUserPassword($user);
                    $this->createUserPhone($user);
                }

                Db::commit();
                return $user_id;
            } catch (\Exception $e){
                Db::rollback();
            }
            return false;
        }

        /*
         * 获取用户信息
         * @param   $user_id
         */
        public function getUserInformation($user_id)
        {
            $user_name = $this->getUserNameByUserId($user_id);
            $phone = $this->getPhoneByUserId($user_id);
            $data = [
                'user_name' =>  $user_name,
                'phone'     =>  $phone,
                'user_id'   =>  $user_id,
            ];
            return $data;
        }

        /*
         * 更改用户信息
         * @param   $user
         */
        public function updateUserInfomation($user)
        {
            if(!isset($user['user_id'])){
                return false;
            }
            Db::startTrans();
            try{
                $this->updateUserName($user);
                $this->updateUserPhone($user);

                Db::commit();
                return true;
            }catch (\Exception $e){
                Db::rollback();
            }
            return false;
        }

        /*
         * 删除用户
         * @param   $user_id
         */
        public function deleteUser($user_id)
        {
            Db::startTrans();
            try{
                $this->deleteUserStatus($user_id);
                $this->deleteUserName($user_id);
                $this->deleteUserPassword($user_id);
                $this->deleteUserPhone($user_id);

                Db::commit();
                return true;
            }catch (\Exception $e){
                Db::rollback();
            }
            return false;
        }

        /*
        * 获取用户总条数
        */
        public function getUserCount()
        {
            $user_model = new Users();
            $rt = $user_model->select();
            return count($rt);
        }
    }

?>