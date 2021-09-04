<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Destination;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DestinationController
 */
class DestinationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $destinations = Destination::factory()->count(3)->create();

        $response = $this->get(route('destination.index'));

        $response->assertOk();
        $response->assertViewIs('destination.index');
        $response->assertViewHas('destinations');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('destination.create'));

        $response->assertOk();
        $response->assertViewIs('destination.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DestinationController::class,
            'store',
            \App\Http\Requests\DestinationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $title = $this->faker->sentence(4);
        $description = $this->faker->text;
        $image = $this->faker->word;
        $price = $this->faker->numberBetween(-10000, 10000);
        $is_open = $this->faker->numberBetween(-8, 8);

        $response = $this->post(route('destination.store'), [
            'title' => $title,
            'description' => $description,
            'image' => $image,
            'price' => $price,
            'is_open' => $is_open,
        ]);

        $destinations = Destination::query()
            ->where('title', $title)
            ->where('description', $description)
            ->where('image', $image)
            ->where('price', $price)
            ->where('is_open', $is_open)
            ->get();
        $this->assertCount(1, $destinations);
        $destination = $destinations->first();

        $response->assertRedirect(route('destination.index'));
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $destination = Destination::factory()->create();

        $response = $this->get(route('destination.edit', $destination));

        $response->assertOk();
        $response->assertViewIs('destination.edit');
        $response->assertViewHas('destination');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DestinationController::class,
            'update',
            \App\Http\Requests\DestinationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $destination = Destination::factory()->create();
        $title = $this->faker->sentence(4);
        $description = $this->faker->text;
        $image = $this->faker->word;
        $price = $this->faker->numberBetween(-10000, 10000);
        $is_open = $this->faker->numberBetween(-8, 8);

        $response = $this->put(route('destination.update', $destination), [
            'title' => $title,
            'description' => $description,
            'image' => $image,
            'price' => $price,
            'is_open' => $is_open,
        ]);

        $destination->refresh();

        $response->assertRedirect(route('destination.index'));

        $this->assertEquals($title, $destination->title);
        $this->assertEquals($description, $destination->description);
        $this->assertEquals($image, $destination->image);
        $this->assertEquals($price, $destination->price);
        $this->assertEquals($is_open, $destination->is_open);
    }
}
