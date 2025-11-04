<?php

namespace App\Console\Commands;

use App\Models\LeaveBalance;
use App\Models\User;
use Illuminate\Console\Command;
use Carbon\Carbon;

class AllocateMonthlyLeave extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leave:allocate-monthly {--month= : Month to allocate (1-12)} {--year= : Year to allocate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Allocate monthly leave quota (1 day per employee) for the specified month and year';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $month = $this->option('month') ?: now()->month;
        $year = $this->option('year') ?: now()->year;

        $this->info("Allocating monthly leave for {$year}-{$month}");

        // Get all active users
        $users = User::where('is_active_employee', true)->get();

        $allocated = 0;
        $skipped = 0;

        foreach ($users as $user) {
            // Check if balance already exists for this month/year
            $existingBalance = LeaveBalance::where('user_id', $user->id)
                ->where('year', $year)
                ->where('month', $month)
                ->first();

            if ($existingBalance) {
                $this->warn("Balance already exists for {$user->name} for {$year}-{$month}");
                $skipped++;
                continue;
            }

            // Create new leave balance
            LeaveBalance::create([
                'user_id' => $user->id,
                'year' => $year,
                'month' => $month,
                'allocated_days' => 1, // 1 day per month
                'used_days' => 0,
                'remaining_days' => 1,
            ]);

            $allocated++;
            $this->info("Allocated 1 day leave to {$user->name}");
        }

        $this->info("Monthly leave allocation completed:");
        $this->info("- Allocated to {$allocated} users");
        $this->info("- Skipped {$skipped} users (already allocated)");

        return Command::SUCCESS;
    }
}
