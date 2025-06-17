<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->generatePartnerName();
        
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(5),
            'description' => $this->generateDescription(),
            'logo' => null, // Logo would be uploaded separately
            'url' => $this->generateUrl($name),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'featured' => $this->faker->boolean(30), // 30% chance of being featured
            'display_order' => $this->faker->numberBetween(1, 100),
            'created_by' => User::factory(),
        ];
    }

    /**
     * Generate a realistic partner name
     */
    private function generatePartnerName(): string
    {
        $types = [
            'Foundation',
            'Trust',
            'Society',
            'Organization',
            'Association',
            'Institute',
            'Centre',
            'Fund',
            'Network',
            'Alliance'
        ];

        $prefixes = [
            'Malaysian',
            'International',
            'Global',
            'National',
            'Regional',
            'Community',
            'United',
            'World',
            'Asia Pacific',
            'Southeast Asian'
        ];

        $focuses = [
            'Children',
            'Education',
            'Healthcare',
            'Environment',
            'Welfare',
            'Development',
            'Relief',
            'Humanitarian',
            'Peace',
            'Youth',
            'Women',
            'Elderly',
            'Community',
            'Research',
            'Innovation'
        ];

        $companyNames = [
            'Petronas',
            'Genting',
            'Public Bank',
            'CIMB',
            'Tenaga Nasional',
            'Axiata',
            'IHH Healthcare',
            'Top Glove',
            'Hartalega',
            'Kossan'
        ];

        $type = $this->faker->randomElement($types);
        
        // 40% chance of being a corporate foundation
        if ($this->faker->boolean(40)) {
            $company = $this->faker->randomElement($companyNames);
            return "{$company} {$type}";
        }
        
        // 60% chance of being a regular NGO/organization
        $prefix = $this->faker->randomElement($prefixes);
        $focus = $this->faker->randomElement($focuses);
        
        return "{$prefix} {$focus} {$type}";
    }

    /**
     * Generate a realistic description
     */
    private function generateDescription(): string
    {
        $activities = [
            'providing humanitarian aid',
            'supporting education initiatives',
            'promoting healthcare access',
            'protecting the environment',
            'empowering communities',
            'advancing research',
            'fostering innovation',
            'building capacity',
            'creating awareness',
            'delivering services'
        ];

        $beneficiaries = [
            'underprivileged communities',
            'children in need',
            'vulnerable families',
            'rural populations',
            'urban poor',
            'elderly citizens',
            'persons with disabilities',
            'marginalized groups',
            'disaster victims',
            'refugees and migrants'
        ];

        $goals = [
            'sustainable development',
            'social justice',
            'poverty alleviation',
            'equality and inclusion',
            'environmental conservation',
            'educational excellence',
            'healthcare improvement',
            'community empowerment',
            'economic development',
            'peace and harmony'
        ];

        $activity = $this->faker->randomElement($activities);
        $beneficiary = $this->faker->randomElement($beneficiaries);
        $goal = $this->faker->randomElement($goals);

        return "A dedicated organization focused on {$activity} to support {$beneficiary} and promote {$goal}. " .
               "We work tirelessly to create positive impact and sustainable change in the communities we serve.";
    }

    /**
     * Generate a realistic URL
     */
    private function generateUrl(string $name): string
    {
        // 20% chance of no URL
        if ($this->faker->boolean(20)) {
            return null;
        }

        $domain = Str::slug(Str::before($name, ' Foundation'))
                . Str::slug(Str::before($name, ' Trust'))
                . Str::slug(Str::before($name, ' Society'));
        
        $domain = Str::limit(Str::slug($domain), 20, '');
        
        $extensions = ['.org', '.org.my', '.com', '.com.my', '.my'];
        $extension = $this->faker->randomElement($extensions);
        
        return "https://www.{$domain}{$extension}";
    }

    /**
     * Indicate that the partner is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'featured' => true,
            'display_order' => $this->faker->numberBetween(1, 10),
        ]);
    }

    /**
     * Indicate that the partner is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the partner is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'inactive',
        ]);
    }

    /**
     * Create a corporate foundation partner.
     */
    public function corporate(): static
    {
        $companies = [
            'Maybank Foundation',
            'CIMB Foundation',
            'Public Bank Foundation',
            'Genting Foundation',
            'Petronas Community Investment',
            'Tenaga Nasional Foundation',
            'Axiata Foundation',
            'IHH Healthcare Foundation',
            'YTL Foundation',
            'Sime Darby Foundation'
        ];

        $company = $this->faker->randomElement($companies);
        
        return $this->state(fn (array $attributes) => [
            'name' => $company,
            'slug' => Str::slug($company) . '-' . Str::random(5),
            'description' => "The {$company} is committed to making a positive impact in the communities where we operate, focusing on education, healthcare, community development, and environmental sustainability.",
            'featured' => $this->faker->boolean(60), // Corporate foundations more likely to be featured
            'status' => 'active', // Corporate foundations usually active
        ]);
    }

    /**
     * Create an international NGO partner.
     */
    public function international(): static
    {
        $ngos = [
            'UNICEF Malaysia',
            'World Vision Malaysia',
            'Oxfam Malaysia',
            'Save the Children Malaysia',
            'Plan International Malaysia',
            'ActionAid Malaysia',
            'Islamic Relief Malaysia',
            'Médecins Sans Frontières Malaysia',
            'Greenpeace Malaysia',
            'WWF Malaysia'
        ];

        $ngo = $this->faker->randomElement($ngos);
        
        return $this->state(fn (array $attributes) => [
            'name' => $ngo,
            'slug' => Str::slug($ngo) . '-' . Str::random(5),
            'description' => "An international non-governmental organization working to improve the lives of vulnerable communities through sustainable development, humanitarian aid, and advocacy for social justice.",
            'featured' => $this->faker->boolean(70), // International NGOs often featured
            'status' => 'active',
        ]);
    }
}
