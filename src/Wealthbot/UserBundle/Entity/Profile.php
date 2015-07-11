<?php

namespace Wealthbot\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Wealthbot\AdminBundle\Entity\CeModel;
use Wealthbot\ClientBundle\Model\Workflow;
use Wealthbot\ClientBundle\Model\WorkflowableInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Wealthbot\UserBundle\Entity\Profile
 */
class Profile implements WorkflowableInterface
{
    const PAYMENT_METHOD_DIRECT_DEBIT = 1;
    const PAYMENT_METHOD_OUTSIDE_PAYMENT = 2;

    /**
     * @var integer
     */
    protected $paymentMethod;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $company
     */
    private $company;

    /**
     * @var string $first_name
     */
    private $first_name = '';

    /**
     * @var string $last_name
     */
    private $last_name = '';

    public function __toString()
    {
        return $this->getFirstName()." ".$this->getLastName();
    }

    /**
     * @return array
     */
    public static function getPaymentMethodChoise()
    {
        return array(
            self::PAYMENT_METHOD_DIRECT_DEBIT    => 'Direct debit',
            self::PAYMENT_METHOD_OUTSIDE_PAYMENT => 'Outside payment'
        );
    }

    /**
     * @param integer $paymentMethod
     * @return string
     */
    public static function getPaymentMethodName($paymentMethod)
    {
        $paymentMethods = static::getPaymentMethodChoise();

        return isset($paymentMethods[$paymentMethod]) ? $paymentMethods[$paymentMethod] : '';
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return Profile
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return Profile
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get first_name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return Profile
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get last_name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }
    /**
     * @var integer $user_id
     */
    private $user_id;

    /**
     * @var \Wealthbot\UserBundle\Entity\User
     */
    private $user;


    /**
     * Set user_id
     *
     * @param integer $userId
     * @return Profile
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set user
     *
     * @param \Wealthbot\UserBundle\Entity\User $user
     * @return Profile
     */
    public function setUser(\Wealthbot\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Wealthbot\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var string $middle_name
     */
    private $middle_name;

    /**
     * @var string $street
     */
    private $street;

    /**
     * @var string $city
     */
    private $city;

    /**
     * @var string $zip
     */
    private $zip;


    /**
     * @var boolean $is_different_address
     */
    private $is_different_address;

    /**
     * @var string $mailing_street
     */
    private $mailing_street;

    /**
     * @var string $mailing_city
     */
    private $mailing_city;


    /**
     * @var string $mailing_zip
     */
    private $mailing_zip;

    /**
     * @var \DateTime $birth_date
     */
    private $birth_date;

    /**
     * @var string $phone_number
     */
    private $phone_number;

    /**
     * @var string $marital_status
     */
    private $marital_status;

    // ENUM values marital_status column
    const CLIENT_MARITAL_STATUS_SINGLE = 'Single';
    const CLIENT_MARITAL_STATUS_MARRIED = 'Married';
    const CLIENT_MARITAL_STATUS_DIVORCED = 'Divorced';
    const CLIENT_MARITAL_STATUS_SEPARATED = 'Separated';

    static private $_clientMaritalStatusValues = null;

    /**
     * @var string $spouse_name
     */
    private $spouse_name;

    /**
     * @var string $annual_income
     */
    private $annual_income;

    // ENUM values annual_income column
    const CLIENT_ANNUAL_INCOME_VALUE1 = '$0-$50,000';
    const CLIENT_ANNUAL_INCOME_VALUE2 = '$50,001-$75,000';
    const CLIENT_ANNUAL_INCOME_VALUE3 = '$75,001-$100,000';
    const CLIENT_ANNUAL_INCOME_VALUE4 = '$100,001-$150,000';
    const CLIENT_ANNUAL_INCOME_VALUE5 = '$150,001-$250,000';
    const CLIENT_ANNUAL_INCOME_VALUE6 = '$250,001 +';

    static private $_clientAnnualIncomeValues = null;

    /**
     * @var string $estimated_income_tax
     */
    private $estimated_income_tax;

    /**
     * @var string $liquid_net_worth
     */
    private $liquid_net_worth;

    // ENUM values liquid_net_worth column
    const CLIENT_LIQUID_NET_WORTH_VALUE1 = '$0-$25,000';
    const CLIENT_LIQUID_NET_WORTH_VALUE2 = '$25,001-$50,000';
    const CLIENT_LIQUID_NET_WORTH_VALUE3 = '$50,001-$100,000';
    const CLIENT_LIQUID_NET_WORTH_VALUE4 = '$100,001-$200,000';
    const CLIENT_LIQUID_NET_WORTH_VALUE5 = '$200,001-$350,000';
    const CLIENT_LIQUID_NET_WORTH_VALUE6 = '$350,001-$700,000';
    const CLIENT_LIQUID_NET_WORTH_VALUE7 = '$700,001-$1,000,000';
    const CLIENT_LIQUID_NET_WORTH_VALUE8 = '$1,000,000 +';

    static private $_clientLiquidNetWorthValues = null;

    /**
     * @var string $employment_type
     */
    private $employment_type;

    // ENUM values liquid_net_worth column
    const CLIENT_EMPLOYMENT_TYPE_EMPLOYED = 'Employed';
    const CLIENT_EMPLOYMENT_TYPE_SELF_EMPLOYED = 'Self-Employed';
    const CLIENT_EMPLOYMENT_TYPE_RETIRED = 'Retired';
    const CLIENT_EMPLOYMENT_TYPE_UNEMPLOYED = 'Unemployed';

    static private $_clientEmploymentTypeValues = null;

    /**
     * @var integer
     */
    private $client_status;

    const CLIENT_STATUS_PROSPECT = 1;
    const CLIENT_STATUS_CLIENT   = 2;

    static private $_clientStatusValues = array(
        self::CLIENT_STATUS_PROSPECT => 'prospect',
        self::CLIENT_STATUS_CLIENT   => 'client'
    );

    /**
     * Set middle_name
     *
     * @param string $middleName
     * @return Profile
     */
    public function setMiddleName($middleName)
    {
        $this->middle_name = $middleName;

        return $this;
    }

    /**
     * Get middle_name
     *
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middle_name;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Profile
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Profile
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zip
     *
     * @param string $zip
     * @return Profile
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }


    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set is_different_address
     *
     * @param boolean $isDifferentAddress
     * @return Profile
     */
    public function setIsDifferentAddress($isDifferentAddress)
    {
        $this->is_different_address = $isDifferentAddress;

        return $this;
    }

    /**
     * Get is_different_address
     *
     * @return boolean
     */
    public function getIsDifferentAddress()
    {
        return $this->is_different_address;
    }

    /**
     * Set mailing_street
     *
     * @param string $mailingStreet
     * @return Profile
     */
    public function setMailingStreet($mailingStreet)
    {
        $this->mailing_street = $mailingStreet;

        return $this;
    }

    /**
     * Get mailing_street
     *
     * @return string
     */
    public function getMailingStreet()
    {
        return $this->mailing_street;
    }

    /**
     * Set mailing_city
     *
     * @param string $mailingCity
     * @return Profile
     */
    public function setMailingCity($mailingCity)
    {
        $this->mailing_city = $mailingCity;

        return $this;
    }


    /**
     * Get mailing_city
     *
     * @return string
     */
    public function getMailingCity()
    {
        return $this->mailing_city;
    }

    /**
     * Set mailing_zip
     *
     * @param string $mailingZip
     * @return Profile
     */
    public function setMailingZip($mailingZip)
    {
        $this->mailing_zip = $mailingZip;

        return $this;
    }

    /**
     * Get mailing_zip
     *
     * @return string
     */
    public function getMailingZip()
    {
        return $this->mailing_zip;
    }

    /**
     * Set birth_date
     *
     * @param \DateTime $birthDate
     * @return Profile
     */
    public function setBirthDate($birthDate)
    {
        $this->birth_date = $birthDate;

        return $this;
    }

    /**
     * Get birth_date
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    /**
     * Set phone_number
     *
     * @param string $phoneNumber
     * @return Profile
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phone_number = $phoneNumber;

        return $this;
    }

    /**
     * Get phone_number
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * Set marital_status
     *
     * @param string $maritalStatus
     * @return Profile
     * @throws \InvalidArgumentException
     */
    public function setMaritalStatus($maritalStatus)
    {
        if (!is_null($maritalStatus) && !in_array($maritalStatus, self::getMaritalStatusChoices())) {
            throw new \InvalidArgumentException(
                sprintf('Invalid value for profile.marital_status : %s.', $maritalStatus)
            );
        }

        $this->marital_status = $maritalStatus;

        return $this;
    }

    /**
     * Get marital_status
     *
     * @return string
     */
    public function getMaritalStatus()
    {
        return $this->marital_status;
    }

    /**
     * Get array ENUM values marital_status column
     *
     * @static
     * @return array
     */
    static public function getMaritalStatusChoices()
    {
        // Build $_clientMaritalStatusValues if this is the first call
        if (self::$_clientMaritalStatusValues == null) {
            self::$_clientMaritalStatusValues = array();
            $oClass = new \ReflectionClass('\Wealthbot\UserBundle\Entity\Profile');
            $classConstants = $oClass->getConstants();
            $constantPrefix = "CLIENT_MARITAL_STATUS_";
            foreach ($classConstants as $key => $val) {
                if (substr($key, 0, strlen($constantPrefix)) === $constantPrefix) {
                    self::$_clientMaritalStatusValues[$val] = $val;
                }
            }
        }

        return self::$_clientMaritalStatusValues;
    }


    /**
     * Set spouse_name
     *
     * @param string $spouseName
     * @return Profile
     */
    public function setSpouseName($spouseName)
    {
        $this->spouse_name = $spouseName;

        return $this;
    }

    /**
     * Get spouse_name
     *
     * @return string
     */
    public function getSpouseName()
    {
        return $this->spouse_name;
    }

    /**
     * Set annual_income
     *
     * @param string $annualIncome
     * @return Profile
     * @throws \InvalidArgumentException
     */
    public function setAnnualIncome($annualIncome)
    {
        if (!is_null($annualIncome) && !in_array($annualIncome, self::getAnnualIncomeChoices())) {
            throw new \InvalidArgumentException(
                sprintf('Invalid value for profile.annual_income : %s.', $annualIncome)
            );
        }

        $this->annual_income = $annualIncome;

        return $this;
    }

    /**
     * Get annual_income
     *
     * @return string
     */
    public function getAnnualIncome()
    {
        return $this->annual_income;
    }

    /**
     * Get array ENUM values marital_status column
     *
     * @static
     * @return array
     */
    static public function getAnnualIncomeChoices()
    {
        // Build $_clientAnnualIncomeValues if this is the first call
        if (self::$_clientAnnualIncomeValues == null) {
            self::$_clientAnnualIncomeValues = array();
            $oClass = new \ReflectionClass('\Wealthbot\UserBundle\Entity\Profile');
            $classConstants = $oClass->getConstants();
            $constantPrefix = "CLIENT_ANNUAL_INCOME_";
            foreach ($classConstants as $key => $val) {
                if (substr($key, 0, strlen($constantPrefix)) === $constantPrefix) {
                    self::$_clientAnnualIncomeValues[$val] = $val;
                }
            }
        }

        return self::$_clientAnnualIncomeValues;
    }

    /**
     * Set estimated_income_tax
     *
     * @param string $estimatedIncomeTax
     * @return Profile
     */
    public function setEstimatedIncomeTax($estimatedIncomeTax)
    {
        $this->estimated_income_tax = $estimatedIncomeTax;

        return $this;
    }

    /**
     * Get estimated_income_tax
     *
     * @return string
     */
    public function getEstimatedIncomeTax()
    {
        return $this->estimated_income_tax;
    }

    /**
     * Set liquid_net_worth
     *
     * @param string $liquidNetWorth
     * @return Profile
     * @throws \InvalidArgumentException
     */
    public function setLiquidNetWorth($liquidNetWorth)
    {
        if (!is_null($liquidNetWorth) && !in_array($liquidNetWorth, self::getLiquidNetWorthChoices())) {
            throw new \InvalidArgumentException(
                sprintf('Invalid value for profile.liquid_net_worth : %s.', $liquidNetWorth)
            );
        }

        $this->liquid_net_worth = $liquidNetWorth;

        return $this;
    }

    /**
     * Get liquid_net_worth
     *
     * @return string
     */
    public function getLiquidNetWorth()
    {
        return $this->liquid_net_worth;
    }

    /**
     * Get array ENUM values liquid_net_worth column
     *
     * @static
     * @return array
     */
    static public function getLiquidNetWorthChoices()
    {
        // Build $_clientLiquidNetWorthValues if this is the first call
        if (self::$_clientLiquidNetWorthValues == null) {
            self::$_clientLiquidNetWorthValues = array();
            $oClass = new \ReflectionClass('\Wealthbot\UserBundle\Entity\Profile');
            $classConstants = $oClass->getConstants();
            $constantPrefix = "CLIENT_LIQUID_NET_WORTH_";
            foreach ($classConstants as $key => $val) {
                if (substr($key, 0, strlen($constantPrefix)) === $constantPrefix) {
                    self::$_clientLiquidNetWorthValues[$val] = $val;
                }
            }
        }

        return self::$_clientLiquidNetWorthValues;
    }

    /**
     * Set employment_type
     * @param string $employmentType
     * @return Profile
     * @throws \InvalidArgumentException
     */
    public function setEmploymentType($employmentType)
    {
        if (!is_null($employmentType) && !in_array($employmentType, self::getEmploymentTypeChoices())) {
           throw new \InvalidArgumentException(
               sprintf('Invalid value for profile.employment_type : %s.', $employmentType)
           );
       }

        $this->employment_type = $employmentType;

        return $this;
    }

    /**
     * Get employment_type
     *
     * @return string
     */
    public function getEmploymentType()
    {
        return $this->employment_type;
    }

    /**
     * Get array ENUM values employment_type column
     *
     * @static
     * @return array
     */
    static public function getEmploymentTypeChoices()
    {
        // Build $_clientEmploymentTypeValues if this is the first call
        if (self::$_clientEmploymentTypeValues == null) {
            self::$_clientEmploymentTypeValues = array();
            $oClass = new \ReflectionClass('\Wealthbot\UserBundle\Entity\Profile');
            $classConstants = $oClass->getConstants();
            $constantPrefix = "CLIENT_EMPLOYMENT_TYPE_";
            foreach ($classConstants as $key => $val) {
                if (substr($key, 0, strlen($constantPrefix)) === $constantPrefix) {
                    self::$_clientEmploymentTypeValues[$val] = $val;
                }
            }
        }

        return self::$_clientEmploymentTypeValues;
    }
    /**
     * @var integer $registration_step
     */
    private $registration_step = 0;


    /**
     * Set registration_step
     *
     * @param integer $registrationStep
     * @return Profile
     */
    public function setRegistrationStep($registrationStep)
    {
        $this->registration_step = $registrationStep;

        return $this;
    }

    /**
     * Get registration_step
     *
     * @return integer
     */
    public function getRegistrationStep()
    {
        return $this->registration_step;
    }
    /**
     * @var integer $ria_user_id
     */
    private $ria_user_id;

    /**
     * @var \Wealthbot\UserBundle\Entity\User
     */
    private $ria;


    /**
     * Set ria_user_id
     *
     * @param integer $riaUserId
     * @return Profile
     */
    public function setRiaUserId($riaUserId)
    {
        $this->ria_user_id = $riaUserId;

        return $this;
    }

    /**
     * Get ria_user_id
     *
     * @return integer
     */
    public function getRiaUserId()
    {
        return $this->ria_user_id;
    }

    /**
     * Set ria
     *
     * @param \Wealthbot\UserBundle\Entity\User $ria
     * @return Profile
     */
    public function setRia(\Wealthbot\UserBundle\Entity\User $ria = null)
    {
        $this->ria = $ria;

        return $this;
    }

    /**
     * Get ria
     *
     * @return \Wealthbot\UserBundle\Entity\User
     */
    public function getRia()
    {
        return $this->ria;
    }


    /**
     * @var integer $questionnaire_step
     */
    private $questionnaire_step;


    /**
     * Set questionnaire_step
     *
     * @param integer $questionnaireStep
     * @return Profile
     */
    public function setQuestionnaireStep($questionnaireStep)
    {
        $this->questionnaire_step = $questionnaireStep;

        return $this;
    }

    /**
     * Get questionnaire_step
     *
     * @return integer
     */
    public function getQuestionnaireStep()
    {
        return $this->questionnaire_step;
    }


    /**
     * @var array $riaRegistrationSteps
     */
    private $riaRegistrationSteps = array(
        'Created Login',
        'Step 1',
        'Step 2',
        'Step 3',
        'Step 4',
        'Registered'
    );

    /**
     * @var array $clientRegistrationSteps
     */
    private $clientRegistrationSteps = array(
        'Created Login',
        'Risk questionnaire',
        'Information Intake',
        'Suggested Portfolio',
        'Advisor Approved Portfolio',
        'Approved Portfolio',
        'Application Screen',
        'Completed All Applications'
    );

    /**
     * Get Registration step for Ria
     *
     * @return string
     */
    public function getRiaRegistrationStep()
    {
        return $this->riaRegistrationSteps[$this->registration_step];
    }

    /**
     * Get Registration step for Client
     *
     * @return string
     */
    public function getClientRegistrationStep()
    {
        return $this->clientRegistrationSteps[$this->registration_step];
    }
    /**
     * @var integer $state_id
     */
    private $state_id;

    /**
     * @var integer $mailing_state_id
     */
    private $mailing_state_id;

    /**
     * @var \Wealthbot\AdminBundle\Entity\State
     */
    private $mailingState;


    /**
     * Set state_id
     *
     * @param integer $stateId
     * @return Profile
     */
    public function setStateId($stateId)
    {
        $this->state_id = $stateId;

        return $this;
    }

    /**
     * Get state_id
     *
     * @return integer
     */
    public function getStateId()
    {
        return $this->state_id;
    }

    /**
     * Set mailing_state_id
     *
     * @param integer $mailingStateId
     * @return Profile
     */
    public function setMailingStateId($mailingStateId)
    {
        $this->mailing_state_id = $mailingStateId;

        return $this;
    }

    /**
     * Get mailing_state_id
     *
     * @return integer
     */
    public function getMailingStateId()
    {
        return $this->mailing_state_id;
    }
    /**
     * @var \Wealthbot\AdminBundle\Entity\State
     */
    private $state;


    /**
     * Set state
     *
     * @param \Wealthbot\AdminBundle\Entity\State $state
     * @return Profile
     */
    public function setState(\Wealthbot\AdminBundle\Entity\State $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \Wealthbot\AdminBundle\Entity\State
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set mailingState
     *
     * @param \Wealthbot\AdminBundle\Entity\State $mailingState
     * @return Profile
     */
    public function setMailingState(\Wealthbot\AdminBundle\Entity\State $mailingState = null)
    {
        $this->mailingState = $mailingState;

        return $this;
    }

    /**
     * Get mailingState
     *
     * @return \Wealthbot\AdminBundle\Entity\State
     */
    public function getMailingState()
    {
        return $this->mailingState;
    }
    /**
     * @var string $spouse_first_name
     */
    private $spouse_first_name;

    /**
     * @var string $spouse_middle_name
     */
    private $spouse_middle_name;

    /**
     * @var string $spouse_last_name
     */
    private $spouse_last_name;


    /**
     * Set spouse_first_name
     *
     * @param string $spouseFirstName
     * @return Profile
     */
    public function setSpouseFirstName($spouseFirstName)
    {
        $this->spouse_first_name = $spouseFirstName;

        return $this;
    }

    /**
     * Get spouse_first_name
     *
     * @return string
     */
    public function getSpouseFirstName()
    {
        return $this->spouse_first_name;
    }

    /**
     * Set spouse_middle_name
     *
     * @param string $spouseMiddleName
     * @return Profile
     */
    public function setSpouseMiddleName($spouseMiddleName)
    {
        $this->spouse_middle_name = $spouseMiddleName;

        return $this;
    }

    /**
     * Get spouse_middle_name
     *
     * @return string
     */
    public function getSpouseMiddleName()
    {
        return $this->spouse_middle_name;
    }

    /**
     * Set spouse_last_name
     *
     * @param string $spouseLastName
     * @return Profile
     */
    public function setSpouseLastName($spouseLastName)
    {
        $this->spouse_last_name = $spouseLastName;

        return $this;
    }

    /**
     * Get spouse_last_name
     *
     * @return string
     */
    public function getSpouseLastName()
    {
        return $this->spouse_last_name;
    }
    /**
     * @var integer $withdraw_age
     */
    private $withdraw_age;


    /**
     * Set withdraw_age
     *
     * @param integer $withdrawAge
     * @return Profile
     */
    public function setWithdrawAge($withdrawAge)
    {
        $this->withdraw_age = $withdrawAge;

        return $this;
    }

    /**
     * Get withdraw_age
     *
     * @return integer
     */
    public function getWithdrawAge()
    {
        return $this->withdraw_age;
    }
    /**
     * @var integer $suggested_portfolio_id
     */
    private $suggested_portfolio_id;

    /**
     * @var CeModel
     */
    private $suggestedPortfolio;


    /**
     * Set suggested_portfolio_id
     *
     * @param integer $suggestedPortfolioId
     * @return Profile
     */
    public function setSuggestedPortfolioId($suggestedPortfolioId)
    {
        $this->suggested_portfolio_id = $suggestedPortfolioId;

        return $this;
    }

    /**
     * Get suggested_portfolio_id
     *
     * @return integer
     */
    public function getSuggestedPortfolioId()
    {
        return $this->suggested_portfolio_id;
    }

    /**
     * Set suggestedPortfolio
     *
     * @param CeModel $suggestedPortfolio
     * @return Profile
     */
    public function setSuggestedPortfolio(CeModel $suggestedPortfolio = null)
    {
        $this->suggestedPortfolio = $suggestedPortfolio;

        return $this;
    }

    /**
     * Get suggestedPortfolio
     *
     * @return CeModel
     */
    public function getSuggestedPortfolio()
    {
        return $this->suggestedPortfolio;
    }

    /**
     * @var string $client_source
     */
    private $client_source = 'web';

    // ENUM values $client_source column
    const CLIENT_SOURCE_WEB = 'web';
    const CLIENT_SOURCE_IN_HOUSE = 'in-house';

    static private $_clientSourceValues = null;

    /**
     * Set client_source
     *
     * @param integer $clientSource
     * @return Profile
     * @throws \InvalidArgumentException
     */
    public function setClientSource($clientSource)
    {
        if (!in_array($clientSource, self::getClientSourceChoices())) {
            throw new \InvalidArgumentException(
                sprintf('Invalid value for profile.client_source : %s.', $clientSource)
            );
        }

        $this->client_source = $clientSource;

        return $this;
    }

    /**
     * Get client_source
     *
     * @return integer
     */
    public function getClientSource()
    {
        return $this->client_source;
    }

    /**
     * Get array ENUM values employment_type column
     *
     * @static
     * @return array
     */
    static public function getClientSourceChoices()
    {
        // Build $_clientEmploymentTypeValues if this is the first call
        if (self::$_clientSourceValues == null) {
            self::$_clientSourceValues = array();
            $oClass = new \ReflectionClass('\Wealthbot\UserBundle\Entity\Profile');
            $classConstants = $oClass->getConstants();
            $constantPrefix = "CLIENT_SOURCE_";
            foreach ($classConstants as $key => $val) {
                if (substr($key, 0, strlen($constantPrefix)) === $constantPrefix) {
                    self::$_clientSourceValues[$val] = $val;
                }
            }
        }

        return self::$_clientSourceValues;
    }

    /**
     * @var integer $client_account_managed
     */
    private $client_account_managed;

    /**
     * Choices for client account management
     */
    public static $client_account_managed_choices = array(
        1 => 'Account Level',
        2 => 'Householder Level'
    );

    /**
     * Set client_account_managed
     *
     * @param integer $clientAccountManaged
     * @return Profile
     */
    public function setClientAccountManaged($clientAccountManaged)
    {
        $this->client_account_managed = $clientAccountManaged;

        return $this;
    }

    /**
     * Get client_account_managed
     *
     * @return integer
     */
    public function getClientAccountManaged()
    {
        return $this->client_account_managed;

    }

    /**
     * Get client_account_managed as string
     *
     * @return string|null
     * @throws \Exception
     */
    public function getClientAccountManagedAsString()
    {
        $level = $this->getClientAccountManaged();
        if (null === $level) {
            return $this->getRia()->getRiaCompanyInformation()->getAccountManagementAsString();
        }

        if (!array_key_exists($level, self::$client_account_managed_choices)) {
            throw new \Exception(sprintf("Value of client account managed for key : %d doesn't exist.", $level));
        }

        return strtolower(self::$client_account_managed_choices[$level]);
    }

    /**
     * @var \DateTime $spouse_birth_date
     */
    private $spouse_birth_date;


    /**
     * Set spouse_birth_date
     *
     * @param \DateTime $spouseBirthDate
     * @return Profile
     */
    public function setSpouseBirthDate($spouseBirthDate)
    {
        $this->spouse_birth_date = $spouseBirthDate;

        return $this;
    }

    /**
     * Get spouse_birth_date
     *
     * @return \DateTime
     */
    public function getSpouseBirthDate()
    {
        return $this->spouse_birth_date;
    }
    /**
     * @var integer
     */
    private $dependents;

    /**
     * @var string
     */
    private $ssn_tin;


    /**
     * Set dependents
     *
     * @param integer $dependents
     * @return Profile
     */
    public function setDependents($dependents)
    {
        $this->dependents = $dependents;

        return $this;
    }

    /**
     * Get dependents
     *
     * @return integer
     */
    public function getDependents()
    {
        return $this->dependents;
    }

    /**
     * Set ssn_tin
     *
     * @param string $ssnTin
     * @return Profile
     */
    public function setSsnTin($ssnTin)
    {
        $this->ssn_tin = $ssnTin;

        return $this;
    }

    /**
     * Get ssn_tin
     *
     * @return string
     */
    public function getSsnTin()
    {
        return $this->ssn_tin;
    }

    /**
     * Returns true if user is client with marital_status = CLIENT_MARITAL_STATUS_MARRIED
     * and false otherwise
     *
     * @return bool
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     */
    public function isMarried()
    {
        $clientRole = 'ROLE_CLIENT';
        if (!$this->getUser()->hasRole($clientRole)) {
            throw new AccessDeniedException(sprintf('User does not have role: %s', $clientRole));
        }

        $status = $this->getMaritalStatus();
        if ($status === Profile::CLIENT_MARITAL_STATUS_MARRIED) {
            return true;
        }

        return false;
    }

    /**
     * Get client status choices
     *
     * @return array
     */
    public static function getClientStatusChoices()
    {
        return self::$_clientStatusValues;
    }

    /**
     * Set client_status
     *
     * @param $clientStatus
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setClientStatus($clientStatus)
    {
        if (!array_key_exists($clientStatus, self::getClientStatusChoices())) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid value: %s for profile.client_status column',
                $clientStatus
            ));
        }

        $this->client_status = $clientStatus;

        return $this;
    }

    /**
     * Get client_status
     *
     * @return integer
     */
    public function getClientStatus()
    {
        return $this->client_status;
    }

    /**
     * Get client status as string
     *
     * @return string
     */
    public function getClientStatusAsString()
    {
        if (!$this->getClientStatus()) {
            return '';
        }

        return self::$_clientStatusValues[$this->getClientStatus()];
    }

    /**
     * Set client status as prospect
     *
     * @return $this
     */
    public function setStatusProspect()
    {
        $this->client_status = self::CLIENT_STATUS_PROSPECT;

        return $this;
    }

    /**
     * Is client has status prospect
     *
     * @return bool
     */
    public function hasStatusProspect()
    {
        return self::CLIENT_STATUS_PROSPECT === $this->getClientStatus();
    }

    /**
     * Set client status as client
     *
     * @return $this
     */
    public function setStatusClient()
    {
        $this->client_status = self::CLIENT_STATUS_CLIENT;

        return $this;
    }

    /**
     * Is client has status client
     *
     * @return bool
     */
    public function hasStatusClient()
    {
        return self::CLIENT_STATUS_CLIENT === $this->getClientStatus();
    }

    /**
     * Get workflow message code
     *
     * @return string
     */
    public function getWorkflowMessageCode()
    {
        return Workflow::MESSAGE_CODE_PAPERWORK_UPDATE_ADDRESS;
    }

    /**
     * @param int $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return int
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

}
