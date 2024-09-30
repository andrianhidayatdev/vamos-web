<?php

namespace App\Logging\Handler;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord; // Import LogRecord
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class DatabaseHandler extends AbstractProcessingHandler
{
  protected function write(LogRecord $record): void
  {
    $user = Auth::user();
    Log::create([
      'level' => $record->level->getName(),
      'message' => $record->message,
      'action' => $record->context['action'],
      'context' => json_encode($record->context['context']),
      'id_cabang' => $user->id_cabang,
      'table_name' => $record->context['table_name'] ?? null,
      'id_row' => $record->context['id_row'] ?? null,
      'user_id' => $user->id,
    ]);
  }
}
