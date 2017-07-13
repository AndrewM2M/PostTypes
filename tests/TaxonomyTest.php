<?php

use PHPUnit\Framework\TestCase;
use PostTypes\Taxonomy;

class TaxonomyTest extends TestCase
{
    public function setUp()
    {
        $this->genres = new Taxonomy('genre');
    }

    /** @test */
    public function canCreateTaxonomy()
    {
        $this->assertInstanceOf(Taxonomy::class, $this->genres);
    }

    /** @test */
    public function hasNameOnInstantiation()
    {
        $this->assertEquals('genre', $this->genres->names['name']);
    }

    /** @test */
    public function hasNamesOnInstantiation()
    {
        $names = [
            'name' => 'genre',
            'singular' => 'Genre',
            'plural' => 'Genres',
            'slug' => 'genres'
        ];

        $genres = new Taxonomy($names);

        $this->assertEquals($genres->names, $names);
    }

    /** @test */
    public function hasOptionsOnInstantiation()
    {
        $this->assertEquals($this->genres->options, []);
    }

    /** @test */
    public function hasCustomOptionsOnInstantiation()
    {
        $options = [
            'public' => true,
        ];

        $genres = new Taxonomy('genre', $options);

        $this->assertEquals($genres->options, $options);
    }

    /** @test */
    public function hasLabelsOnInstatiation()
    {
        $this->assertEquals($this->genres->labels, []);
    }

    /** @test */
    public function hasCustomLabelsOnInstantiation()
    {
        $labels = [
            'name' => 'Genres',
            'add_new' => 'Add New Genre'
        ];

        $genres = new Taxonomy('genre', [], $labels);

        $this->assertEquals($genres->labels, $labels);
    }

    /** @test */
    public function namesCreatedFromName()
    {
        $this->genres->createNames();

        $this->assertEquals($this->genres->name, 'genre');
        $this->assertEquals($this->genres->singular, 'Genre');
        $this->assertEquals($this->genres->plural, 'Genres');
        $this->assertEquals($this->genres->slug, 'genres');
    }

    /** @test */
    public function passedNamesAreUsed()
    {
        $names = [
            'name' => 'genre',
            'singular' => 'Single Genre',
            'plural' => 'Multiple Genres',
            'slug' => 'slug-genres',
        ];

        $this->genres->names($names);

        $this->genres->createNames();

        $this->assertEquals($this->genres->name, 'genre');
        $this->assertEquals($this->genres->singular, 'Single Genre');
        $this->assertEquals($this->genres->plural, 'Multiple Genres');
        $this->assertEquals($this->genres->slug, 'slug-genres');
    }
}