<?php

namespace Wealthbot\ClientBundle\Form\Type;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Wealthbot\ClientBundle\Entity\AccountGroup;
use Wealthbot\ClientBundle\Entity\AccountGroupType;
use Wealthbot\UserBundle\Entity\User;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class TypedClientAccountFormType extends ClientAccountFormType
{
    private $em;
    private $groupType;

    public function __construct(EntityManager $em, User $client, AccountGroupType $groupType = null, $group = AccountGroup::GROUP_EMPLOYER_RETIREMENT, $validateAdditionalFields = true)
    {
        $this->em = $em;
        $this->groupType = $groupType;

        parent::__construct($client, $group, $validateAdditionalFields);
    }

    protected function buildFormForFinancialInstitution(FormBuilderInterface $builder)
    {
        if ($this->groupType) {
            $builder->add('groupType', 'hidden', array(
                'data' => $this->groupType->getId(),
                'mapped' => false
            ));
        } else {
            $group = $this->group;
            $isAllowRetirementPlan = $this->isAllowRetirementPlan;

            $builder->add('groupType', 'entity', array(
                'class' => 'WealthbotClientBundle:AccountGroupType',
                'query_builder' => function(EntityRepository $er) use ($group, $isAllowRetirementPlan) {
                    $qb = $er->createQueryBuilder('gt');
                    $qb
                        ->leftJoin('gt.group', 'g')
                        ->where('g.name = :group')
                        ->setParameter('group', AccountGroup::GROUP_DEPOSIT_MONEY)
                    ;
                    return $qb;
                },
                'property' => 'type.name',
                'label' => 'Account Type',
                'empty_value' => 'Select Type'
            ));
        }

        $builder
            ->add('financial_institution', 'text', array(
                'constraints' => array(new NotBlank()),
                'label' => 'Financial Institution:'
            ))
            ->add('transferInformation', new AccountTransferInformationFormType($this->em), array(
                'label' => ' '
            ))
            ->add('value', 'number', array(
                'grouping' => true,
                'precision' => 2,
                'label' => 'Estimated Deposit:',
                'constraints' => array(new NotBlank())
            ));
    }

    protected function buildFormForDepositMoney(FormBuilderInterface $builder)
    {
        if ($this->groupType) {
            $builder->add('groupType', 'hidden', array(
                'data' => $this->groupType->getId(),
                'mapped' => false
            ));
        } else {
            $group = $this->group;
            $isAllowRetirementPlan = $this->isAllowRetirementPlan;

            $builder->add('groupType', 'entity', array(
                'class' => 'WealthbotClientBundle:AccountGroupType',
                'query_builder' => function(EntityRepository $er) use ($group, $isAllowRetirementPlan) {
                    $qb = $er->createQueryBuilder('gt');
                    $qb
                        ->leftJoin('gt.group', 'g')
                        ->where('g.name = :group')
                        ->setParameter('group', AccountGroup::GROUP_DEPOSIT_MONEY)
                    ;
                    return $qb;
                },
                'property' => 'type.name',
                'label' => 'Account Type',
                'empty_value' => 'Select Type'
            ));
        }

        $builder->add('value', 'number', array(
            'grouping' => true,
            'precision' => 2,
            'label' => 'Estimated Deposit:',
            'constraints' => array(new NotBlank())
        ));
    }
}