<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetStoreRequest;
use App\Service\PetApiClientService;

class ApiPetController extends Controller
{

    private PetApiClientService $petService;

    public function __construct(PetApiClientService $petService) {
        $this->petService = $petService;
    }

    public function show(int $petId)
    {
        $data = $this->petService->get($petId);

        return view('pet.show', $data);
    }

    public function create()
    {
        return view('pet.create');
    }

    public function store(PetStoreRequest $request)
    {
        $request->validated();

        $data = $this->prepareBaseData($request);

        $data = $this->petService->seve($data, 'create');

            return redirect()->route('main.pet')
                ->with($data);
    }

    public function edit(int $petId)
    {
        $data = $this->petService->get($petId); 

        return view('pet.edit', $data);
    } 

    public function update(PetStoreRequest $request, int $id)
    {
        $request->validated();

        $data = $this->prepareBaseData($request);
        $data['id'] = $id;

        $data = $this->petService->seve($data, 'update');

        return redirect()->route('main.pet')
            ->with($data);
    }

    public function destroy(int $id)
    {

        $data = $this->petService->delete($id); 
        
        if($data['success'] ?? false){
            return redirect()->route('main.pet')
                ->with([
                    'message' => "The pet with id:$id has been deleted",
                ]);

        } else {
            return redirect()->back()
                ->with([
                    'error' => 'Something went wrong, please try again later',
                    'code' => $data['code']
                ]);
        }
    }

    private function prepareBaseData($data): array
    {
        return  [
            "category" => [
              "name" => $data['category']
            ],
            "name" => $data['name'],
            "photoUrls" => [
                $data['photoUrls']
            ],
            "tags" => [
              [
                "name" => $data['tags']
              ]
            ],
            "status" => $data['status']
        ];
    
    }
}
