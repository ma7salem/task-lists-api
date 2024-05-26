<?php

namespace Tests\Unit;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTodoListRelationTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_a_user_can_has_many_todo_lists(): void
    {
        $user = $this->actAsUser();
        $user->todolists()->create(['name' => 'todo 1']);
        $user->todolists()->create(['name' => 'todo 2']);

        $this->assertInstanceOf(TodoList::class, $user->todolists()->first());
    }

    public function test_a_todo_list_belongs_to_a_user(): void
    {
        $user = $this->actAsUser();
        $list = $user->todolists()->create(['name' => 'todo 1']);

        $this->assertInstanceOf(User::class, $list->user);
    }
}
