<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'document_type',
        'document_name',
        'file_path',
        'file_name',
        'mime_type',
        'file_size',
        'expiry_date',
        'is_verified',
        'notes'
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'is_verified' => 'boolean',
        'file_size' => 'integer'
    ];

    protected $dates = [
        'deleted_at'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessors
    public function getFileSizeFormattedAttribute()
    {
        if (!$this->file_size) return '-';

        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getDocumentTypeLabelAttribute()
    {
        return match($this->document_type) {
            'ktp' => 'KTP',
            'npwp' => 'NPWP',
            'bpjs_health' => 'BPJS Kesehatan',
            'bpjs_employment' => 'BPJS Ketenagakerjaan',
            'ijazah' => 'Ijazah',
            'cv' => 'CV/Resume',
            'photo' => 'Foto',
            'contract' => 'Kontrak Kerja',
            'certificate' => 'Sertifikat',
            default => ucwords(str_replace('_', ' ', $this->document_type))
        };
    }

    public function getIsExpiredAttribute()
    {
        return $this->expiry_date && $this->expiry_date->isPast();
    }

    public function getStatusBadgeAttribute()
    {
        if ($this->is_verified) {
            return '<span class="badge bg-success">Verified</span>';
        }

        if ($this->is_expired) {
            return '<span class="badge bg-danger">Expired</span>';
        }

        return '<span class="badge bg-warning">Pending</span>';
    }

    // Scopes
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeExpired($query)
    {
        return $query->where('expiry_date', '<', now());
    }

    public function scopeByType($query, $type)
    {
        return $query->where('document_type', $type);
    }
}
