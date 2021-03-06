<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AdminUsersRepository;
use App\Entities\AdminUsers;
use App\Validators\AdminUsersValidator;

/**
 * Class AdminUsersRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AdminUsersRepositoryEloquent extends BaseRepository implements AdminUsersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminUsers::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getUsersBasedOnTheConditions($inputs) {
      // Table: stores, user_infos, users
      // user_name, sex, last_name, first_name, birthday-start-date, birthday-end-date, email, tel, start-date, end-date, store_name

      // user_name
      // sex
      // last_name, first_name
      // birthday-start-date, birthday-end-date
      // email
      // tel
      // start-date, end-date
      // store_name
      return $this->model->whereHas('stores');
    }

    public function getAdminUser($adminuser_id) {
      return $this->model->when($adminuser_id, function($query) use ($adminuser_id) {
        return $query->where('id', $adminuser_id);
      });
    }

    public function getAdminUsersByPositionCode($admin_user_info_id) {
      $adminuserinfo = $this->model->when($admin_user_info_id, function($query) use ($admin_user_info_id) {
        return $query->where('id', $admin_user_info_id);
      });
      return $this->model->filterByPositionCode($adminuserinfo['position_code'])->get();
    }
}
