namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of transactions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $transactions = Transaction::all(); // Retrieve all transactions
        return view('admin.transactions.index', compact('transactions')); // Pass data to the view
    }
}
