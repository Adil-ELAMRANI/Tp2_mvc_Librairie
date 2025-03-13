<?php
// ModelLog.php
// Gestion du journal des actions utilisateurs

namespace App\Models;
use App\Models\Crud;

class Log extends Crud {
    protected $table = 'logs';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'ip_address', 'action', 'message', 'date'];

    public static function add($userId, $action, $message) {
        $db = new self();
        return $db->insert([
            'user_id' => $userId,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'action' => $action,
            'message' => $message,
            'date' => date('Y-m-d H:i:s')
        ]);
    }
}
