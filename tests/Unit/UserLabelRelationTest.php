<?php

namespace Tests\Unit;

use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLabelRelationTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_a_user_can_has_many_labels(): void
    {
        $user = $this->actAsUser();
        $user->labels()->create(['title' => 'lbl 1', 'color' => 'white']);
        $user->labels()->create(['title' => 'lbl 2', 'color' => 'red']);

        $this->assertInstanceOf(Label::class, $user->labels()->first());
    }
}
