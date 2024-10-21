<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Don; // Ajoutez cette ligne pour importer la classe Don
use App\Models\Stock; 

class UpdateStockForExpiredDons extends Command
{
    protected $signature = 'stock:update-expired-dons';
    protected $description = 'Met à jour le stock pour les dons dont la date de péremption est atteinte';

    public function handle()
    {
        // Récupérer tous les dons périmés
        $expiredDons = Don::where('date_preemption', '<=', Carbon::now())->get();

        foreach ($expiredDons as $don) {
            // Trouvez le stock correspondant à la catégorie du don
            $stockItem = Stock::where('sub_category', $don->sub_category)->first();
            if ($stockItem) {
                // Diminuez la quantité du stock
                $stockItem->quantity -= $don->quantity;
                $stockItem->save(); // Enregistrez les modifications
            }
            // Supprimez le don périmé
            $don->delete();
        }

        $this->info('Le stock a été mis à jour pour les dons périmés.');
    }
}