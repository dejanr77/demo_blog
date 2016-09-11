<?php

use App\Models\Acl\Permission;
use App\Models\Acl\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscriberRole = Role::create([
            'name' => 'subscriber',
            'slug' => 'subscriber',
        ]);

        $authorRole = Role::create([
            'name' => 'author',
            'slug' => 'author',
        ]);

        $adminRole = Role::create([
            'name' => 'admin',
            'slug' => 'admin',
        ]);

        $tmpRole = Role::create([
            'name' => 'tmp',
            'slug' => 'tmp',
        ]);


        $createArticlePermission = Permission::create([
            'name' => 'create article',
            'slug' => 'article.create',
        ]);
        $updateArticlePermission = Permission::create([
            'name' => 'update article',
            'slug' => 'article.update',
        ]);
        $deleteArticlePermission = Permission::create([
            'name' => 'delete article',
            'slug' => 'article.delete',
        ]);
        $uploadPermission = Permission::create([
            'name' => 'upload file',
            'slug' => 'upload.file',
        ]);
        $createCommentPermission = Permission::create([
            'name' => 'create comment',
            'slug' => 'comment.create',
        ]);


        $adminAccessPermission = Permission::create([
            'name' => 'administration access',
            'slug' => 'admin.access',
        ]);
        $trashArticlePermission = Permission::create([
            'name' => 'trash of articles',
            'slug' => 'article.trash',
        ]);
        $trashCommentPermission = Permission::create([
            'name' => 'trash of comments',
            'slug' => 'comment.trash',
        ]);
        $publishArticlePermission = Permission::create([
            'name' => 'publish article',
            'slug' => 'article.publish',
        ]);
        $restoreArticlePermission = Permission::create([
            'name' => 'restore article',
            'slug' => 'article.restore',
        ]);
        $restoreCommentPermission = Permission::create([
            'name' => 'restore comment',
            'slug' => 'comment.restore',
        ]);
        $createTagPermission = Permission::create([
            'name' => 'create tag',
            'slug' => 'tag.create',
        ]);
        $menageTagPermission = Permission::create([
            'name' => 'tag menage',
            'slug' => 'tag.menage',
        ]);
        $menageUserPermission = Permission::create([
            'name' => 'menage user',
            'slug' => 'user.menage',
        ]);


        $subscriberRole->assignPermission([
            $createCommentPermission->id,
        ]);

        $authorRole->assignPermission([
            $createArticlePermission->id,
            $updateArticlePermission->id,
            $deleteArticlePermission->id,
            $createCommentPermission->id,
            $uploadPermission->id
        ]);


        $adminRole->assignPermission([
            $createArticlePermission->id,
            $updateArticlePermission->id,
            $deleteArticlePermission->id,
            $uploadPermission->id,
            $createCommentPermission->id,
            $adminAccessPermission->id,
            $trashCommentPermission->id,
            $trashArticlePermission->id,
            $publishArticlePermission->id,
            $restoreArticlePermission->id,
            $restoreCommentPermission->id,
            $createTagPermission->id,
            $menageTagPermission->id,
            $menageUserPermission->id,
        ]);

        $admin = User::create([
            'name' => env('ADMIN_NAME', 'Admin'),
            'email' => env('ADMIN_EMAIL', 'dejan@sma.il'),
            'password' => bcrypt(env('ADMIN_PASSWORD', '111111'))
        ]);

        if(! $admin->save()) {
            Log::info('Unable to create admin '.$admin->name, (array)$admin->errors());
        } else {
            $admin->assignRole($adminRole->id);
            Log::info('Created admin "'.$admin->name.'" <'.$admin->email.'>');
        }
    }
}


