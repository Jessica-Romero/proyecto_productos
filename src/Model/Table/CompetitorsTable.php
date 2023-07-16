<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\Http\Client;
use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Competitors Model
 *
 * @method \App\Model\Entity\Competitor newEmptyEntity()
 * @method \App\Model\Entity\Competitor newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Competitor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Competitor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Competitor findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Competitor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Competitor[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Competitor|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Competitor saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Competitor[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Competitor[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Competitor[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Competitor[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CompetitorsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('competitors');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('CompetitorPrices');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
    public function updateCompetitors()
    {
        $http = new Client();
        $response = $http->get(Configure::read('Atida.urls.competitorsUrl'));

        if ($response->isOk()) {
            $content = $response->getStringBody();
        }

        $filePath = WWW_ROOT . 'repo/prices/'.date('Y-m-d').'csv';

        $fp = fopen($filePath, 'w+');
        fwrite($fp, print_r($content, true));
        fclose($fp);
        $items = array();
        $xproduct = array();
        $price = array();
        $products= array();
        $row = 1;

        //addCompetitors to DataBase
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
                if(($num == 10)){
                    if(($row != 1)&($data[7]!='dosfarma')) {
                        array_push($items, $data[7]);
                    }
                }else {
                    echo "finished add Competitor \n";
                }
                $row++;
            }
            fclose($handle);
        }
        $competitorsCsv = array_unique($items);
        $index = array_keys($competitorsCsv);
        foreach ($index as $id) {
            $competitors = $this->find('list')->toArray();
            array_search($competitorsCsv[$id],$competitors)?array_search($competitorsCsv[$id],$competitors):$this->addNewCompetitor($competitorsCsv[$id]);
        }

        echo "addCompetitorPrice \n";

        $row = 2;
        //addCompetitorPrice
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
                if($num == 10){
                    if(($row > 1)&($data[7]!='dosfarma')&(!empty($data[8]))) {
                        if ($row == 2) {
                            array_push($xproduct, $data[0], $data [7]);
                            array_push($price, $data[8]);
                        } else {
                            if (($xproduct[0] == $data[0]) & ($xproduct[1] == $data[7])) {
                                array_push($price, $data[8]);
                            } else {
                                $competitor_id = $this->CompetitorPrices->Competitors->findByName($xproduct[1])
                                    ->select('id')
                                    ->first();
                                $product_id = $this->CompetitorPrices->Products->findBySku($xproduct[0])
                                    ->select('id')
                                    ->first();

//                                if(!$product_id){
//                                    print_r('no existe el producto');
//                                }else{
//                                    $num=str_replace(',','.',min($price));
//                                    $product = $this->CompetitorPrices->find()
//                                        ->where(['CompetitorPrices.product_id' => $product_id['id'],'CompetitorPrices.competitor_id' =>$competitor_id['id']])
//                                        ->first();
//                                    //If CompetitorPrice doesn't exist
//                                    if(!$product){
//                                        $product = $this->newEmptyEntity();
//                                        $product->competitor_id = $competitor_id['id'];
//                                        $product->product_id = $product_id['id'];
//                                        $product->price = (double)$num;
//                                        $products[] = $product;
//                                    }else{
//                                        $product->price = (double)$num;
//                                        $products[] = $product;
//                                    }
//                                }
                                if($product_id){
                                    $num=str_replace(',','.',min($price));
                                    $product = $this->CompetitorPrices->find()
                                     ->where(['CompetitorPrices.product_id' => $product_id['id'],'CompetitorPrices.competitor_id' =>$competitor_id['id']])->first();
                                  //If CompetitorPrice doesn't exist
                                  if(!$product){
                                       $product = $this->newEmptyEntity();
                                       $product->competitor_id = $competitor_id['id'];
                                      $product->product_id = $product_id['id'];
                                      $product->price = (double)$num;
                                       $products[] = $product;
                                  }else{
                                        $product->price = (double)$num;
                                       $products[] = $product;
                                  }
                                }
                                $xproduct = array();
                                $price = array();
                                array_push($xproduct, $data[0], $data [7]);
                                array_push($price, $data[8]);

                            }
                        }
                    }
                }else {
                    echo "finished competitor Price \n";
                }
                $row++;
            }
            fclose($handle);
        }
        $this->CompetitorPrices->saveMany($products);

    }

    public function addNewCompetitor($name)
    {
        $result = 0;
        $competitor = $this->newEmptyEntity();
        $competitor->name = $name;
        if ($this->save($competitor)) {
            $result = $competitor->id;
        }else{

            Log::write('error', 'An error ocurred adding {competitor}', ['competitor' => $name]);
            $result = false;
        }
        Log::write('info', 'The competitors added', ['competitor' => $competitor->name]);

        return $result;

    }
}
