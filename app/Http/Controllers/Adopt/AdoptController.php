<?php

namespace App\Http\Controllers\Adopt;

use App\Http\Controllers\Controller;
use App\Http\Resources\Adopt\PetResource;
use App\Models\Adopt\Adopt;
use App\Models\User;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdoptController extends Controller
{


    public function show($id)
    {
        $pet = Adopt::where('status',1)->where('id',$id)->first();

        return Inertia::render('Adopt/ShowPet',[
            'pet' =>$pet ? new PetResource($pet) : null
        ]);
    }

    public function index()
    {
        $pets = Adopt::where('status',1)->orderBy('created_at','desc')->paginate(15);

        return Inertia::render('Adopt/AllPets',[
            'pets' =>PetResource::collection($pets)
        ]);
    }
    public function create()
    {
        return Inertia::render('Adopt/NewAdopt');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' =>'bail|required',
            'image'=> 'bail|required|url',
            'breed'=> 'bail|required',
            'age'=> 'bail|required',
            'location'=> 'bail|required',
            'description'=> 'bail|required',
        ]);

        try {

            Adopt::create([
               'user_id' => auth()->id(),
               'name' => $validatedData['name'],
               'image' => $validatedData['image'],
               'breed' => $validatedData['breed'],
               'age' => $validatedData['age'],
               'location' => $validatedData['location'],
                'description' => $validatedData['description']
            ]);

            $user = new User();
            $admin = $user->getAdmin();
            $admin->notify((new AdminNotification('New pet adoption request for review.' )));

            return response()->json(['status' => 'success','message' => 'Site added successfully'],200);
        }catch (\Exception $e){
            return response()->json(['status' => 'error','message' => $e->getMessage()],422);
        }



    }



}
