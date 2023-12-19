<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\Spaces\Enums\EnumSpaceActivityStatus;
use App\Domains\Spaces\Enums\EnumSpaceVerificationStatus;
use App\Domains\Spaces\Models\Tables\TableSpace as _;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

class SpaceFactory extends Factory
{
    public function definition(): array
    {
        $socials_name = fake()->userName();

        return [
            _::name => 'Space Name '.fake()->randomNumber(3),
            _::description => fake()->paragraph(),
            _::socials_json => $this->socials($socials_name)->toJson(),
            _::schedule_text => fake()->paragraph(),
            _::gallery_json => $this->gallery()->toJson(),
            _::website_url => fake()->url(),
            _::space_activity_status => EnumSpaceActivityStatus::ACTIVE,
            _::space_verification_status => EnumSpaceVerificationStatus::VERIFIED,
        ];
    }

    // TODO: withUsers()
    // TODO: withEvents()
    // TODO: withLocation()
    // TODO: verificationStatus() // NO state needed
    // TODO: activityStatus() // NO state needed

    public function configure(): static
    {
        return $this->afterMaking(function () {
        })->afterCreating(function () {
        });
    }

    private function socials(string $socials_name): Collection
    {
        return collect([
            'facebook' => 'https://www.facebook.com/',
            'instagram' => 'https://www.instagram.com/',
            'twitter' => 'https://twitter.com/',
            'youtube' => 'https://www.youtube.com/',
            'tiktok' => 'https://www.tiktok.com/',
            'linkedin' => 'https://www.linkedin.com/',
            'telegram' => 'https://telegram.org/',
            'whatsapp' => 'https://www.whatsapp.com/',
            'signal' => 'https://signal.org/',
            'wechat' => 'https://www.wechat.com/',
            'line' => 'https://line.me/',
        ])->map(function ($url, $name) use ($socials_name) {
            return [
                _::name => $name,
                _::website_url => $url.$socials_name,
            ];
        });
    }

    private function gallery(): Collection
    {
        return collect([
            fake()->imageUrl(640, 480, 'places', true),
            fake()->imageUrl(640, 480, 'places', true),
            fake()->imageUrl(640, 480, 'places', true),
            fake()->imageUrl(640, 480, 'places', true),
            fake()->imageUrl(640, 480, 'places', true),

        ])->map(function ($url) {
            return [
                'url' => $url,
                'title' => 'Image_title',
            ];
        });
    }
}
