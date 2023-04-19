<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $products = $this->Products->find('list')->all();
        $n_products = count($products);
        $this->viewBuilder()->setLayout('products');
        $this->paginate = [
            'contain' => ['Brands', 'CompetitorPrices' => ['Competitors']],
            'limit' => $n_products,
            'maxLimit' => 1500
        ];
        $products = $this->paginate($this->Products);
        $brands = $this->Products->Brands->find('list', ['limit' => 200])->all();
        $products_filters = $this->request->getSession()->read('Config.products_filters')?$this->request->getSession()->read('Config.products_filters'):[];
        $count_total = $this->Products->find('all')->count();
        $this->set(compact('products', 'brands', 'products_filters', 'count_total'));
        //$this->viewBuilder()->setOption('serialize', ['products']);


    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Brands'],
        ]);

        $this->set(compact('product'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $brands = $this->Products->Brands->find('list', ['limit' => 200])->all();
        $this->set(compact('product', 'brands'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $brands = $this->Products->Brands->find('list', ['limit' => 200])->all();
        $this->set(compact('product', 'brands'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function ajaxFilterProducts($brand_id = null)
    {
        if ($this->request->is('ajax')) {
            $this->disableAutoRender();
            $data = $this->request->getData();
            if($data['brand_id']== null){
                $products = $this->Products->find('list')->toArray();
            }else {
                $products = $this->Products->find('list')->where(['brand_id' => $data['brand_id']])->toArray();
            }
            if ($products) {
                echo json_encode($products
                );
                exit;
            } else {
                echo json_encode(array(
                    "status" => "ko",
                    "message" => __('An error occurred getting this task')
                ));
            }
        }
    }

//    public function addByFile(){
//
//        $suppliers = $this->Products->Suppliers->find('list', ['limit' => 200])->all();
//        $this->set(compact('suppliers'));
//    }

//    public function addProductByCsv()
//    {
//        $this->disableAutoRender();
//        if ($this->request->is("post")) {
//            $file = $this->request->getData('file');
//        }
//        $hasFileError = "";
//        if(!is_null($file) ){
//            $hasFileError = $file->getError();
//        }
//        $fileName = $file->getClientFilename();
//
//        $filePath = WWW_ROOT . 'repo/Products/'.$fileName;
//        $file->moveTo($filePath);
//        $allProducts=array();
//        $columnsName = array();
//        $row = 1;
//        if (($handle = fopen($filePath, "r")) !== FALSE) {
//            while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
//                $productsCsv = array();
//                $num = count($data);
//                if($row == 1){
//                    $titles= $data;
//                    foreach($data as $k => $value){
//                        $columnsName[] = $this->map($titles[$k]);
//                    }
//                }else{
//                    foreach($data as $k => $value){
//                        $productsCsv[$this->map($titles[$k])]= $this->matchValue($this->map($titles[$k]),$value);
//                    }
////                    $productTable = $this->fetchTable('Products');
////                    $product = $productTable->findBySku($data[0])->first();
////                    if(!$product) {
////                        $product = $productTable->newEntity($productsCsv,['validate' => false]);
////
////                    }else {
////                        $product = $productTable->patchEntity($product,$productsCsv,['validate' => false]);
////                    }
//                    $allProducts[]= $productsCsv;
//                }
//                $row++;
//            }
//            fclose($handle);
//        }
//        $allProducts[]= $columnsName;
//        if ($allProducts) {
//            echo json_encode($allProducts);
//            exit;
//        } else {
//            echo json_encode(array(
//                "status" => "ko",
//                "message" => __('An error occurred getting this task')
//            ));
//        }
////        $productTable->saveMany($allProducts);
//    }

//    public function map($title)
//    {
//        $title = trim($title); //delete white space
//
//        switch($title)
//        {
//            case 'Referencia interna del proveedor':
//                $name = 'sku';
//                break;
//            case 'EAN':
//                $name = 'ean';
//                break;
//            case 'Código nacional':
//                $name = 'national_code';
//                break;
//            case 'Código hs':
//                $name = 'hs_code';
//                break;
//            case 'Nombre':
//                $name = 'name';
//                break;
//            case 'Marca':
//                $name = 'brand_id';
//                break;
//            case 'Sub Marca':
//                $name = 'sub_brand_id';
//                break;
//            case 'Color':
//                $name = 'color';
//                break;
//            case 'Descripción larga':
//                $name = 'long_description';
//                break;
//            case 'Descripción corta':
//                $name = 'short_description';
//                break;
//            case 'Consejo farmaceutico':
//                $name = 'pharmaceutical_advice';
//                break;
//            case 'Consejo de uso':
//                $name = 'usage_advice';
//                break;
//            case 'Factores medioambientales':
//                $name = 'environmental_factors';
//                break;
//            case 'Edad target':
//                $name = 'target_age';
//                break;
//            case 'Parte del cuerpo target':
//                $name = 'target_body';
//                break;
//            case 'Género target':
//                $name = 'gender_target';
//                break;
//            case 'Vida útil desde producción':
//                $name = 'shelf_life_from_production';
//                break;
//            case 'Siglas o marcas impresas en el embalaje':
//                $name = 'marks_printed_on_packaging';
//                break;
//            case 'Requiere almacenamiento en frío':
//                $name = 'cold_storage';
//                break;
//            case 'Lista de ingredientes':
//                $name = 'ingredients_list';
//                break;
//            case 'Estupefaciente':
//                $name = 'narcotic';
//                break;
//            case 'Psicotrópico':
//                $name = 'psychotropic';
//                break;
//            case 'Descripción tipo de aportación':
//                $name = 'description_type_of_contribution';
//                break;
//            case 'Indicador de peligrosidad':
//                $name = 'is_dangerous';
//                break;
//            case 'Código de grupo terapéutico (ATC)':
//                $name = 'atc';
//                break;
//            case 'Contenido':
//                $name = 'content';
//                break;
//            case 'Unidad de medida del contenido':
//                $name = 'content_unit';
//                break;
//            case 'Formato de producto':
//                $name = 'product_format';
//                break;
//            case 'Peso del Producto':
//                $name = 'product_weight';
//                break;
//            case 'Unidad de medida del peso del producto':
//                $name = 'product_weight_unit';
//                break;
//            case 'Longitud del producto':
//                $name = 'product_length';
//                break;
//            case 'Unidad de medida para la longitud del producto':
//                $name = 'product_length_unit';
//                break;
//            case 'Altura del producto':
//                $name = 'product_height';
//                break;
//            case 'Unidad de medida de altura del producto':
//                $name = 'product_height_unit';
//                break;
//            case 'Profundidad del producto':
//                $name = 'product_depth';
//                break;
//            case 'Unidad de medida de profundidad del producto':
//                $name = 'product_depth_unit';
//                break;
//            case 'Formato del embalaje':
//                $name = 'packing_format';
//                break;
//            case 'Pedido mínimo aceptable y formato de pedido mínimo (Caja o unidad) (ejemplo :3 cajas)':
//                $name = 'min_order_format';
//                break;
//            case 'Peso del paquete':
//                $name = 'package_weight';
//                break;
//            case 'Unidad de medida para el peso del paquete':
//                $name = 'package_weight_unit';
//                break;
//            case 'Longitud del paquete':
//                $name = 'package_length';
//                break;
//            case 'Unidad de medida para la longitud del paquete':
//                $name = 'package_length_unit';
//                break;
//            case 'Altura del paquete':
//                $name = 'package_height';
//                break;
//            case 'Unidad de medida de la altura del paquete':
//                $name = 'package_height_unit';
//                break;
//            case 'Profundidad del paquete':
//                $name = 'package_depth';
//                break;
//            case 'Unidad de medida de profundidad del paquete':
//                $name = 'package_depth_unit';
//                break;
//            case 'Volumen del paquete':
//                $name = 'package_volume';
//                break;
//            case 'Unidad de medida del volumen del paquete':
//                $name = 'package_volume_unit';
//                break;
//            case 'Longitud del palet':
//                $name = 'pallet_length';
//                break;
//            case 'Unidad de medida para la longitud del palet':
//                $name = 'pallet_length_unit';
//                break;
//            case 'Altura del palet':
//                $name = 'pallet_height';
//                break;
//            case 'Unidad de medida de la altura del palet':
//                $name = 'pallet_height_unit';
//                break;
//            case 'Profundidad del palet':
//                $name = 'pallet_depth';
//                break;
//            case 'Unidad de medida de profundidad del palet':
//                $name = 'pallet_depth_unit';
//                break;
//            case 'Volumen del palet':
//                $name = 'pallet_volume';
//                break;
//            case 'Unidad de medida del volumen del palet':
//                $name = 'pallet_volume_unit';
//                break;
//            case 'Capas/Palet':
//                $name = 'layers_pallet';
//                break;
//            case 'Cajas/Capa':
//                $name = 'boxes_layer';
//                break;
//            case 'Cajas/Palet':
//                $name = 'boxes_pallet';
//                break;
//            case 'Precio Recomendado c/ IVA':
//                $name = 'recommended_price_vat';
//                break;
//            case 'Precio Venta c/ IVA':
//                $name = 'sale_price_vat';
//                break;
//            case 'Precio Coste s/ IVA':
//                $name = 'cost_price';
//                break;
//            case '% IVA':
//                $name = 'vat';
//                break;
//            case 'Principios activos':
//                $name = 'active_principles';
//                break;
//            case 'Unidades por caja':
//                $name = 'units_per_box';
//                break;
//            default:
//                $name= $title;
//        }
//        return $name;
//    }

//    public function matchValue($title,$value)
//    {
//        switch($title)
//        {
//            case 'ean':
//            case 'sku':
//            case 'national_code':
//            case 'hs_code':
//            case 'color':
//            case 'long_description':
//            case 'short_description':
//            case 'pharmaceutical_advice':
//            case 'usage_advice':
//            case 'environmental_factors':
//            case 'target_body':
//            case 'gender_target':
//            case 'marks_printed_on_packaging':
//            case 'ingredients_list':
//            case 'narcotic':
//            case 'psychotropic':
//            case 'description_type_of_contribution':
//            case 'is_dangerous':
//            case 'content':
//            case 'content_unit':
//            case 'product_format':
//            case 'product_weight_unit':
//            case 'product_length_unit':
//            case 'product_height_unit':
//            case 'product_depth_unit':
//            case 'packing_format':
//            case 'min_order_format':
//            case 'package_weight_unit':
//            case 'package_length_unit':
//            case 'package_height_unit':
//            case 'package_depth_unit':
//            case 'package_volume_unit':
//            case 'pallet_length_unit':
//            case 'pallet_height_unit':
//            case 'pallet_depth_unit':
//            case 'pallet_volume_unit':
//            case 'vat':
//            case 'active_principles':
//                if($value=='')
//                {
//                    $value='empty';
//                }
//                break;
//            case 'product_weight':
//            case 'product_length':
//            case 'product_height':
//            case 'product_depth':
//            case 'package_weight':
//            case 'package_length':
//            case 'package_height':
//            case 'package_depth':
//            case 'package_volume':
//            case 'pallet_length':
//            case 'pallet_height':
//            case 'pallet_depth':
//            case 'pallet_volume':
//            case 'recommended_price_vat':
//            case 'sale_price_vat':
//            case 'cost_price':
//                if($value=='')
//                {
//                    $value = (double)0;
//                }else {
//                    $valueOk = str_replace(',', '.', $value);
//                    $value = (double)$valueOk;
//                }
//                break;
//            case 'target_age':
//            case 'shelf_life_from_production':
//            case 'atc':
//            case 'layers_pallet':
//            case 'boxes_layer':
//            case 'boxes_pallet':
//            case 'units_per_box':
//                if($value=='')
//                {
//                    $value =0;
//                }else
//                    $value = (integer)$value;
//                break;
//            case 'cold_storage':
//                ($value=='No')?$value=false:$value=true;
//                break;
////            case 'brand_id':
////                $xBrandId= $this->findBrandId($value,false,0);
////                $value = $xBrandId;
////            case 'sub_brand_id':
////                ($value=='')?$value= '':$value= $this->findBrandId($value,true,$xBrandId);
////                break;
//            default:
//                $value = $value;
//
//        }
//        return $value;
//    }

//    public function findBrandId($name,$isSubBrand,$xBrandId)
//    {
//        $brandTable = $this->fetchTable('Brands');
//        $brand_id = $brandTable->findByName($name)->ToArray();
//        if ($brand_id == null) {
//            $newBrand = $brandTable->newEmptyEntity();
//            $newBrand->name = $name;
//            $newBrand->image = 'no img';
//            if($isSubBrand == true){
//                $newBrand->brand_parent_id =$xBrandId;
//            }
//            $brandTable->save($newBrand);
//            $brand_id = $newBrand->id;
//            return $brand_id;
//        } else {
//            $brand_id = $brand_id[0]->id;
//            return $brand_id;
//        }
//    }

//    public function saveProducts(){
//        $this->disableAutoRender();
//        if ($this->request->is("post")) {
//            $datos = $this->request->getData('data');
//            $nameColums = $this->request->getData('nameColums');
//            $rows =  (integer)$this->request->getData('rows');
//            $supplier_id =  (integer)$this->request->getData('supplier_id');
//        }
//        $allProducts = array();
//        $productsSave = array();
//        $allProductsToSaved= array();
//        $i=0;
//        while($i<$rows) {
//            $productsSave = array_combine($nameColums,$datos[$i]);
//            $i++;
//            $allProducts[]= $productsSave;
//        }
//        foreach ($allProducts as $colum) {
//            foreach ($colum as $k => $value) {
//                switch ($k) {
//                    case 'brand_id':
//                        $xBrandId = $this->findBrandId($value, false, 0);
//                        $productsSave[$k] = $xBrandId;
//                        break;
//                    case 'sub_brand_id':
//                        ($value == '') ? $value = '' : $productsSave[$k] = $this->findBrandId($value, true, $productsSave['brand_id']);
//                        break;
//                    case 'cold_storage':
//                        ($value == 'false') ? $productsSave[$k] = false : $productsSave[$k] = true;
//                        break;
//                    case 'vat':
//                        $productsSave[$k] = $value;
//                        $productTable = $this->fetchTable('Products');
//                        $product = $productTable->findBySku($productsSave['sku'])->first();
//                        if (!$product) {
//                            $product = $productTable->newEntity($productsSave, ['validate' => 'File']);
//                            $product->supplier_id = $supplier_id;
//                        } else {
//                            $product = $productTable->patchEntity($product, $productsSave, ['validate' => 'File']);
//                        }
//                        $allProductsToSaved[] = $product;
//                    default :
//                        $productsSave[$k] = $value;
//                }
//            }
//        }
//        if($productTable->saveMany($allProductsToSaved)){
//            echo json_encode(array(
//                "status" => 'ok',
//            ));
//            exit;
//        }else{
//            echo json_encode(array(
//                "status" => "ko",
//                "message" => __('An error occurred adding the product')
//            ));
//        }
//    }

}
