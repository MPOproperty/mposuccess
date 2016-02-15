<?php

namespace MPOproperty\Mpouspehm\WalletOne;

use MPOproperty\Mpouspehm\BinaryTree\Sheet;
use MPOproperty\Mpouspehm\Contracts\WalletOne\RequestInterface;
use MPOproperty\Mpouspehm\Models\User;
use DateTime;

/**
 * Class Request
 * @package MPOproperty\Walletone
 */
class Request implements RequestInterface
{
    /**
     * Идентификатор (номер кошелька) интернет-магазина, полученный при регистрации.
     *
     * @var integer
     */
    protected $WMI_MERCHANT_ID;

    /**
     * Сумма заказа — число округленное до 2-х знаков после «запятой»,
     * в качестве разделителя используется «точка». Наличие 2-х знаков
     * после «запятой» обязательно.
     *
     * @var float
     */
    protected $WMI_PAYMENT_AMOUNT;

    /**
     * Идентификатор валюты (ISO 4217):
     *   643 — Российские рубли
     *   710 — Южно-Африканские ранды
     *   840 — Американские доллары
     *   978 — Евро
     *   980 — Украинские гривны
     *   398 — Казахстанские тенге
     *   974 — Белорусские рубли
     *   972 — Таджикские сомони
     *
     * @var integer
     */
    protected $WMI_CURRENCY_ID;

    /**
     * Идентификатор заказа в системе учета интернет-магазина.
     * Значение данного параметра должно быть уникальным для каждого заказа.
     *
     * @var integer
     */
    protected $WMI_PAYMENT_NO;

    /**
     * Описание заказа (список товаров и т.п.) — отображается на
     * странице оплаты заказа, а также в истории платежей покупателя.
     * Максимальная длина 255 символов.
     *
     * @var string
     */
    protected $WMI_DESCRIPTION;

    /**
     * Адреса (URL) страниц интернет-магазина, на которые будет
     * отправлен покупатель после успешной оплаты.
     *
     * @var string
     */
    protected $WMI_SUCCESS_URL;

    /**
     * Адреса (URL) страниц интернет-магазина, на которые будет
     * отправлен покупатель после  неуспешной оплаты.
     *
     * @var string
     */
    protected $WMI_FAIL_URL;

    /**
     * Срок истечения оплаты. Дата указывается в западно-европейском
     * часовом поясе (UTC+0) и должна быть больше текущей (ISO 8601),
     * например: 2013-10-29T11:39:26.
     *
     * Обратите внимание: срок действия счёта не может превышать
     * 30 дней с момента выставления!
     *
     * @var \DateTime
     */
    protected $WMI_EXPIRED_DATE;

    /**
     * С помощью этих параметров можно управлять доступными способами оплаты.
     *
     * @var array
     */
    protected $WMI_PTENABLED;

    /**
     * С помощью этих параметров можно управлять доступными способами оплаты.
     *
     * @var array
     */
    protected $WMI_PTDISABLED;

    /**
     * Логин плательщика по умолчанию. Значение данного параметра будет автоматически
     * подставляться в поле логина при авторизации. Возможные форматы: электронная
     * почта, номер телефона в международном формате.
     *
     * @var string
     */
    protected $WMI_RECIPIENT_LOGIN;

    /**
     * Имя плательщика. Значения данных параметров будут
     * автоматически подставляться в формы некоторых способов оплаты.
     *
     * @var string
     */
    protected $WMI_CUSTOMER_FIRSTNAME;

    /**
     * Фамилия плательщика. Значения данных параметров будут
     * автоматически подставляться в формы некоторых способов оплаты.
     *
     * @var string
     */
    protected $WMI_CUSTOMER_LASTNAME;

    /**
     * Email плательщика. Значения данных параметров будут
     * автоматически подставляться в формы некоторых способов оплаты.
     *
     * @var string
     */
    protected $WMI_CUSTOMER_EMAIL;

    /**
     * Язык интерфейса определяется автоматически, но можно задать его:
     *  ru-RU;
     *  en-US.
     *
     * @var string
     */
    protected $WMI_CULTURE_ID;

    /**
     * Подпись платежной формы, сформированная с использованием
     * «секретного ключа» интернет-магазина. Необходимость проверки
     * этого параметра устанавливается в настройках интернет-магазина.
     *
     * @var string
     */
    protected $WMI_SIGNATURE;

    /**
     * Все остальные поля платежной формы, не имеющие префикс «WMI_»,
     * будут сохранены и переданы в интернет-магазин.
     *
     * @var array
     */
    protected $EXTRA_DATA;

    /*
     *
     */
    public function __construct($user)
    {
        $this->init($user);
    }

    /*
     *
     */
    private function init($user)
    {
        $date = new DateTime();
        $date->modify("+" . config('welletone.WMI_EXPIRED_DATE') . " day");
        $this->WMI_EXPIRED_DATE = $date->format('Y-m-d\TH:i:sP');
        $this->WMI_MERCHANT_ID = config('welletone.WMI_MERCHANT_ID');
        $this->WMI_CURRENCY_ID = config('welletone.WMI_CURRENCY_ID');
        $this->WMI_SUCCESS_URL = config('welletone.WMI_SUCCESS_URL');
        $this->WMI_FAIL_URL = config('welletone.WMI_FAIL_URL');
        $this->WMI_CULTURE_ID = config('welletone.WMI_CULTURE_ID');
        $this->WMI_RECIPIENT_LOGIN = $user->email;
        $this->WMI_CUSTOMER_FIRSTNAME = Sheet::rus2translit($user->name);
        $this->WMI_CUSTOMER_LASTNAME =  Sheet::rus2translit($user->surname);
        $this->WMI_CUSTOMER_EMAIL = $user->email;
        //todo Из-за этого массива неправильно формируется цифровая подпись
//        $this->WMI_PTENABLED = $this->enabled();
    }

    private function enabled()
    {
        $enabled = config('welletone.WMI_PTENABLED');
        uksort($enabled, "strcasecmp");
        return array_keys($enabled, true);
    }

    public function genSignature($params = array(), $str = '')
    {
        // Формирование сообщения, путем объединения значений формы,
        // отсортированных по именам ключей в порядке возрастания.
        uksort($params, "strcasecmp");
        array_walk_recursive($params, function ($value) use (&$str) {
            if (is_array($value)) {
                foreach ($value as $v) {
                    $str .= $v;
                }
            } else {
                $str .= $value;
            }
        });
        // Формирование значения параметра WMI_SIGNATURE, путем
        // вычисления отпечатка, сформированного выше сообщения,
        // по алгоритму MD5 и представление его в Base64
        return base64_encode(pack("H*", md5($str . config('welletone.WMI_KEY'))));
    }

    /**
     * Отправка платежной формы
     *
     * @param $paymentSid
     * @return mixed
     */
    public function send($paymentSid)
    {
        $this->WMI_PAYMENT_NO = $paymentSid;
        $this->WMI_SIGNATURE = $this->genSignature(get_object_vars($this));

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://wl.walletone.com/checkout/checkout/Index');
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(get_object_vars($this)));
        curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 10');
        curl_setopt($curl, CURLOPT_REFERER, 'http://wl.walletone.com');
        $res = curl_exec($curl);
        if (!$res) {
            throw new \InvalidArgumentException("Ошибка передачи данных " . curl_error($curl) . "(" . curl_errno($curl) . ")");
        }
        curl_close($curl);

        return $res;
    }

    /**
     * @return float
     */
    public function getPaymentAmount()
    {
        return $this->WMI_PAYMENT_AMOUNT;
    }

    /**
     * @param float $WMI_PAYMENT_AMOUNT
     */
    public function setPaymentAmount($WMI_PAYMENT_AMOUNT)
    {
        if (!is_float($WMI_PAYMENT_AMOUNT)) {
            $this->toPaymentFormat($WMI_PAYMENT_AMOUNT);
        }
        $this->WMI_PAYMENT_AMOUNT = $WMI_PAYMENT_AMOUNT;
    }

    /**
     * Конвертация числа в денежный формат
     * @param $WMI_PAYMENT_AMOUNT
     * @return string
     */
    public function toPaymentFormat($WMI_PAYMENT_AMOUNT)
    {
        return number_format((float)$WMI_PAYMENT_AMOUNT, 2, '.', '');
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->WMI_DESCRIPTION;
    }

    /**
     * @param string $WMI_DESCRIPTION
     */
    public function setDescription($WMI_DESCRIPTION)
    {
        if (!is_string($WMI_DESCRIPTION)) {
            throw new \InvalidArgumentException("Описание заказа должно быть переданы в виде строки.");
        }
        $this->WMI_DESCRIPTION = "BASE64:" . base64_encode($WMI_DESCRIPTION); //urlencode($WMI_DESCRIPTION);
    }

    /**
     * @return array
     */
    public function getExtraData()
    {
        return $this->EXTRA_DATA;
    }

    /**
     * @param array $EXTRA_DATA
     */
    public function setExtraData($EXTRA_DATA)
    {
        if (!is_array($EXTRA_DATA)) {
            throw new \InvalidArgumentException("Дополнительные параметры должны быть переданы в виде массива.");
        }
        $this->EXTRA_DATA = $EXTRA_DATA;
    }

    public function parseCheckoutResponse($page)
    {
        $dom = new \DOMDocument();
        $dom->loadHTML($page);
        foreach ($dom->getElementsByTagName('a') as $node) {
            $url = $node->getAttribute("href");
        }

        if (!isset($url)) {
            throw new \InvalidArgumentException("Неверный ответ от серерва Wallet");
        }

        return config('welletone.WALLETONE_URL') . $url;
    }

}