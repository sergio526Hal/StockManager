<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Category extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        if (!session()->get('user_id')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Not authenticated');
        }
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $data = [
            'categories' => $this->categoryModel->findAll(),
        ];
        return view('category/index', $data);
    }

    public function create()
    {
        return view('category/create');
    }

    public function store()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status') ?? 'active',
        ];

        if ($this->categoryModel->save($data)) {
            return redirect()->to('/category')->with('success', 'Catégorie créée avec succès');
        }

        return redirect()->back()->with('error', 'Erreur lors de la création');
    }

    public function edit($id)
    {
        $data = [
            'category' => $this->categoryModel->find($id),
        ];
        return view('category/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
        ];

        if ($this->categoryModel->update($id, $data)) {
            return redirect()->to('/category')->with('success', 'Catégorie mise à jour');
        }

        return redirect()->back()->with('error', 'Erreur lors de la mise à jour');
    }

    public function delete($id)
    {
        if ($this->categoryModel->delete($id)) {
            return redirect()->to('/category')->with('success', 'Catégorie supprimée');
        }

        return redirect()->back()->with('error', 'Erreur lors de la suppression');
    }
}
