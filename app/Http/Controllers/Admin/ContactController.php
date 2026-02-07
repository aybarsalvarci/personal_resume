<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $contacts = $query
            ->paginate(10)
            ->withQueryString();

        return view('admin.contact.index', compact('contacts'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);

        try {
            $contact->status = 'read';
            $contact->save();
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect()->back()->withError('Bir hata oluştu.');
        }

        return view('admin.contact.show', compact('contact'));

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);

        try {
            $contact->delete();
        }
        catch (\Exception $e) {
            Log::error("Contact silinirken bir hata oluştu: " . $e->getMessage(), $e->getTrace());
            return redirect()->back()->with('error', "Mesaj silinirken bir hata oluştu.");
        }

        return redirect()->route('admin.contacts.index')->with('success', "Mesaj silindi.");
    }
}
