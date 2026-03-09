<?php

use App\Models\Application;
use App\Models\Conversation;
use App\Models\Experience;
use App\Models\Project;
use App\Models\User;

beforeEach(function () {
    $this->withoutVite();
});

test('guest users are redirected from protected collaboration routes', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();
    $project = Project::create([
        'user_id' => $owner->id,
        'title' => 'Community Cleanup',
        'description' => 'Help coordinate the event.',
        'status' => 'Open',
        'schedule_details' => 'Saturday morning',
        'location_address' => 'Jakarta',
        'volunteers_needed' => 10,
    ]);
    $conversation = Conversation::create();
    $conversation->participants()->attach([$owner->id, $otherUser->id]);
    $experience = Experience::create([
        'user_id' => $owner->id,
        'title' => 'Volunteer',
        'organization' => 'SkillConnect',
        'start_date' => '2025-01-01',
    ]);
    $application = Application::create([
        'user_id' => $otherUser->id,
        'project_id' => $project->id,
    ]);

    $this->post(route('experience.store'))->assertRedirect(route('login'));
    $this->get(route('experience.edit', $experience))->assertRedirect(route('login'));
    $this->patch(route('experience.update', $experience))->assertRedirect(route('login'));
    $this->delete(route('experience.destroy', $experience))->assertRedirect(route('login'));

    $this->get(route('messages.index'))->assertRedirect(route('login'));
    $this->get(route('messages.start', $otherUser))->assertRedirect(route('login'));
    $this->get(route('messages.show', $conversation))->assertRedirect(route('login'));
    $this->post(route('messages.store', $conversation))->assertRedirect(route('login'));

    $this->post(route('comments.store', $project))->assertRedirect(route('login'));
    $this->post(route('users.follow', $otherUser))->assertRedirect(route('login'));
    $this->post(route('projects.apply', $project))->assertRedirect(route('login'));
    $this->patch(route('applications.update', $application))->assertRedirect(route('login'));
    $this->post(route('projects.toggleSave', $project))->assertRedirect(route('login'));
    $this->post(route('projects.toggleLike', $project))->assertRedirect(route('login'));
});

test('only the project owner can update an application status', function () {
    $owner = User::factory()->create();
    $applicant = User::factory()->create();
    $outsider = User::factory()->create();

    $project = Project::create([
        'user_id' => $owner->id,
        'title' => 'Mentorship Session',
        'description' => 'Support new contributors.',
        'status' => 'Open',
        'schedule_details' => 'Next week',
        'location_address' => 'Remote',
        'volunteers_needed' => 2,
    ]);

    $application = Application::create([
        'user_id' => $applicant->id,
        'project_id' => $project->id,
    ]);

    $this->actingAs($outsider)
        ->patch(route('applications.update', $application), ['status' => 'accepted'])
        ->assertForbidden();

    $this->actingAs($owner)
        ->patch(route('applications.update', $application), ['status' => 'accepted'])
        ->assertRedirect();

    expect($application->fresh()->status)->toBe('accepted');
});
