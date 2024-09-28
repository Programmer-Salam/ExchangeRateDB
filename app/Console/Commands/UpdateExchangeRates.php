<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Currency;
use App\Models\CurrencyHistory;
use Illuminate\Support\Facades\Log;

class UpdateExchangeRates extends Command
{
    protected $signature = 'exchange:update';
    protected $description = 'Update exchange rates from XML source';

    public function handle()
    {
        // Log the start of the process
        Log::info('Exchange rates update started.');

        try {
            $xmlUrl = 'http://www.cbr.ru/scripts/XML_daily.asp';
            $xmlData = simplexml_load_file($xmlUrl);

            foreach ($xmlData->Valute as $valute) {
                $CharCode = (string) $valute->CharCode;
                $rate = (float) str_replace(',', '.', $valute->Value) / (int) $valute->Nominal;

                // Log each currency update
                Log::info("Updating currency: {$CharCode} with rate: {$rate}");

                $currency = Currency::updateOrCreate(
                    ['name' => $CharCode],
                    ['rate' => $rate]
                );

                // Log history creation
                CurrencyHistory::create([
                    'currency_id' => $currency->id,
                    'rate' => $rate
                ]);
            }

            Log::info('Exchange rates update completed successfully.');

        } catch (\Exception $e) {
            // Log any errors
            Log::error('Failed to update exchange rates: ' . $e->getMessage());
            // Display the error message in the console
            $this->error('Failed to update exchange rates. Check the log file for more details.');
        }
    }
}
