<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareInvestment extends Model
{
    use HasFactory;

    public const CATEGORIES = [
        'daily' => 'দৈনিক',
        'weekly' => 'সাপ্তাহিক',
        'monthly' => 'মাসিক',
        'one_time' => 'এককালীন',
    ];

    public const ADDRESS_PREFIXES = [
        'customer_permanent',
        'customer_present',
        'nominee_permanent',
        'nominee_present',
    ];

    public const ADDRESS_FIELDS = [
        'holding_no' => 'হোল্ডিং নং',
        'village' => 'গ্রাম/মহল্লা',
        'ward_no' => 'ওয়ার্ড নং',
        'union' => 'ইউনিয়ন',
        'thana' => 'থানা',
        'district' => 'জেলা',
    ];

    protected $guarded = ['id'];

    public function getApplicationNoAttribute(): string
    {
        return 'SI-' . str_pad((string) $this->id, 5, '0', STR_PAD_LEFT);
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->investment_category] ?? $this->investment_category;
    }

    public function address(string $prefix): string
    {
        $parts = [];
        foreach (self::ADDRESS_FIELDS as $field => $label) {
            $value = $this->{"{$prefix}_{$field}"};
            if (filled($value)) {
                $parts[] = "{$label}: {$value}";
            }
        }

        return $parts ? implode(', ', $parts) : '—';
    }
}
