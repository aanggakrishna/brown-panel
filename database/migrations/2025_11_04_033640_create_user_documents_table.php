<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('document_type'); // ktp, npwp, bpjs_health, bpjs_employment, ijazah, cv, etc.
            $table->string('document_name'); // Nama dokumen
            $table->string('file_path'); // Path file yang disimpan
            $table->string('file_name'); // Nama file asli
            $table->string('mime_type')->nullable(); // Tipe file
            $table->integer('file_size')->nullable(); // Ukuran file dalam bytes
            $table->date('expiry_date')->nullable(); // Tanggal kadaluarsa (untuk dokumen yang memiliki expiry)
            $table->boolean('is_verified')->default(false); // Status verifikasi dokumen
            $table->text('notes')->nullable(); // Catatan tambahan
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['user_id', 'document_type']);
            $table->index('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_documents');
    }
};
