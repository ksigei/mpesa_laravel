namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'amount',
        'account_reference',
        'transaction_desc',
        'status',
    ];
}
