<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(SimpleNoteSeeder::class);

        Model::reguard();
    }
}

class SimpleNoteSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
 
        $password = Hash::make('password');
 
        $users_table = array(
            ['id' => 1, 'name' => 'John Smith', 'email' => 'JohnSmith@Somewhere.com', 'password' => $password, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'name' => 'John Doe',   'email' => 'JohnDoe@Somewhere.com',   'password' => $password, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 3, 'name' => 'Jane Doe',   'email' => 'JaneDoe@Somewhere.com',   'password' => $password, 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );
 
        DB::table('users')->insert($users_table);
        
        DB::table('simple-notes')->delete();
 
        $simple_notes_table = array(
            ['id' => 1, 'user_id' => 1, 'title' => 'title for notes 1',  'content' => 'content for note 1', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'user_id' => 1, 'title' => 'title for notes 2',  'content' => 'content for note 2', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 3, 'user_id' => 2, 'title' => 'title for notes 3',  'content' => 'content for note 3', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 4, 'user_id' => 2, 'title' => 'title for notes 4',  'content' => 'content for note 4', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 5, 'user_id' => 3, 'title' => 'title for notes 5',  'content' => 'content for note 5', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 6, 'user_id' => 3, 'title' => 'title for notes 6',  'content' => 'content for note 6', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );
 
        DB::table('simple-notes')->insert($simple_notes_table);
    }

}