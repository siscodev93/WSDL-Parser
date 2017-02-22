<?php
class test 
{

    protected $client = null;

    public function __construct($url = 'http://www.webservicex.com/country.asmx?wsdl', $context = array())
    {
        $this->client = new SoapClient($url, $context);
    }

	private $GetCountryByCountryCode = array(
		'CountryCode' => null
	);

	private $GetCountryByCountryCodeResponse = array(
		'GetCountryByCountryCodeResult' => null
	);

	private $GetISD = array(
		'CountryName' => null
	);

	private $GetISDResponse = array(
		'GetISDResult' => null
	);

	private $GetCountriesResponse = array(
		'GetCountriesResult' => null
	);

	private $GetCurrencyCodeByCurrencyName = array(
		'CurrencyName' => null
	);

	private $GetCurrencyCodeByCurrencyNameResponse = array(
		'GetCurrencyCodeByCurrencyNameResult' => null
	);

	private $GetISOCountryCodeByCountyName = array(
		'CountryName' => null
	);

	private $GetISOCountryCodeByCountyNameResponse = array(
		'GetISOCountryCodeByCountyNameResult' => null
	);

	private $GetCurrencyCodeResponse = array(
		'GetCurrencyCodeResult' => null
	);

	private $GetCountryByCurrencyCode = array(
		'CurrencyCode' => null
	);

	private $GetCountryByCurrencyCodeResponse = array(
		'GetCountryByCurrencyCodeResult' => null
	);

	private $GetCurrenciesResponse = array(
		'GetCurrenciesResult' => null
	);

	private $GetCurrencyByCountry = array(
		'CountryName' => null
	);

	private $GetCurrencyByCountryResponse = array(
		'GetCurrencyByCountryResult' => null
	);

	private $GetGMTbyCountry = array(
		'CountryName' => null
	);

	private $GetGMTbyCountryResponse = array(
		'GetGMTbyCountryResult' => null
	);


    public function GetCountryByCountryCode( $CountryCode )
    {
        $r = $this->client->GetCountryByCountryCode( array( 'CountryCode' => $CountryCode ) );
        return $r->GetCountryByCountryCodeResult; 
    }
    public function GetISD( $CountryName )
    {
        $r = $this->client->GetISD( array( 'CountryName' => $CountryName ) );
        return $r->GetISDResult; 
    }
    public function GetCountries(  )
    {
        $r = $this->client->GetCountries(  );
        return $r->GetCountriesResult; 
    }
    public function GetCurrencyCodeByCurrencyName( $CurrencyName )
    {
        $r = $this->client->GetCurrencyCodeByCurrencyName( array( 'CurrencyName' => $CurrencyName ) );
        return $r->GetCurrencyCodeByCurrencyNameResult; 
    }
    public function GetISOCountryCodeByCountyName( $CountryName )
    {
        $r = $this->client->GetISOCountryCodeByCountyName( array( 'CountryName' => $CountryName ) );
        return $r->GetISOCountryCodeByCountyNameResult; 
    }
    public function GetCurrencyCode(  )
    {
        $r = $this->client->GetCurrencyCode(  );
        return $r->GetCurrencyCodeResult; 
    }
    public function GetCountryByCurrencyCode( $CurrencyCode )
    {
        $r = $this->client->GetCountryByCurrencyCode( array( 'CurrencyCode' => $CurrencyCode ) );
        return $r->GetCountryByCurrencyCodeResult; 
    }
    public function GetCurrencies(  )
    {
        $r = $this->client->GetCurrencies(  );
        return $r->GetCurrenciesResult; 
    }
    public function GetCurrencyByCountry( $CountryName )
    {
        $r = $this->client->GetCurrencyByCountry( array( 'CountryName' => $CountryName ) );
        return $r->GetCurrencyByCountryResult; 
    }
    public function GetGMTbyCountry( $CountryName )
    {
        $r = $this->client->GetGMTbyCountry( array( 'CountryName' => $CountryName ) );
        return $r->GetGMTbyCountryResult; 
    }
}
$t = new test();
$result = $t->GetCurrencyByCountry("United States");//
var_dump($result);