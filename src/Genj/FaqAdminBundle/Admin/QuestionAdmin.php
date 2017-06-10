<?php

namespace Genj\FaqAdminBundle\Admin;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class QuestionAdmin
 *
 * @package Genj\FaqAdminBundle\Admin
 */
class QuestionAdmin extends Admin
{
    protected $datagridValues = array(
        '_page'       => 1,
        '_sort_by'    => 'issueDate',
        '_sort_order' => 'Desc'
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('headline')
            ->add('body')
            ->add('category')
            ->add('isActive')
            ->add('slug');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('headline', null, array('identifier' => true))
            ->add('Category')
            ->add('rank')
            ->add('isActive')
            ->add('publishAt')
            ->add('_action', 'actions',
                array(
                    'actions' => array(
                        'show'   => array(),
                        'edit'   => array(),
                        'delete' => array()
                    )
                )
            );
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Basics', array('class' => 'col-md-8'))
                ->add('headline')
                ->add('body', null, array('required' => false))
            ->end()

            ->with('Status', array('class' => 'col-md-4'))
                ->add('isActive', ChoiceType::class, array(
                        'choices'  => array(
                            'draft'     => 0,
                            'published' => 1
                        ),
                        'expanded' => true,
                        'required' => true,
                        'label'    => 'Status',
                        'attr'     => array('class' => 'radio-list')
                    )
                )
                ->add('publishAt', null, array('date_format' => 'd M y'))
                ->add('expiresAt', null, array('date_format' => 'd M y'))
                ->add('rank', null, array('required' => false))
                ->add('category', null, array(
                    'expanded' => true,
                    'required' => true
                    )
                )
                ->add('slug', null, array('required' => false))
            ->end();
    }
}
