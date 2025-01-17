<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductsCategories Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 *
 * @method \App\Model\Entity\ProductsCategory newEmptyEntity()
 * @method \App\Model\Entity\ProductsCategory newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductsCategory> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductsCategory get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ProductsCategory findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ProductsCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductsCategory> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductsCategory|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ProductsCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ProductsCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductsCategory>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductsCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductsCategory> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductsCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductsCategory>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductsCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductsCategory> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProductsCategoriesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('products_categories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
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
            ->integer('product_id')
            ->notEmptyString('product_id');

        $validator
            ->integer('category_id')
            ->notEmptyString('category_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['product_id', 'category_id']), ['errorField' => 'product_id']);
        $rules->add($rules->existsIn(['product_id'], 'Products'), ['errorField' => 'product_id']);
        $rules->add($rules->existsIn(['category_id'], 'Categories'), ['errorField' => 'category_id']);

        return $rules;
    }
}
