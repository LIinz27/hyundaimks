<?php

namespace Tests\Unit;

use App\Models\Sales;
use PHPUnit\Framework\TestCase;

class WhatsappNormalizationTest extends TestCase
{
    public function test_whatsapp_link_normalizes_various_formats(): void
    {
        $cases = [
            // [input, expected wa.me digits]
            '0812-3456-7890' => '6281234567890',
            '0812 3456 7890' => '6281234567890',
            '+62 812-3456-7890' => '6281234567890',
            '6281234567890' => '6281234567890',
            '81234567890' => '6281234567890',
            '(0812) 345-6789' => '628123456789',
            '62 812 3456 7890' => '6281234567890',
        ];

        foreach ($cases as $input => $expected) {
            $sales = new Sales(['whatsapp' => $input]);

            $this->assertSame(
                'https://wa.me/'.$expected,
                $sales->whatsappLink(),
                "Format [{$input}] seharusnya ternormalisasi menjadi {$expected}"
            );
        }
    }

    public function test_whatsapp_link_returns_null_for_empty_or_invalid(): void
    {
        $this->assertNull((new Sales(['whatsapp' => null]))->whatsappLink());
        $this->assertNull((new Sales(['whatsapp' => '']))->whatsappLink());
        $this->assertNull((new Sales(['whatsapp' => 'abc']))->whatsappLink());
    }
}
