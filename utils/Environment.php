<?php

class Environment {
    private static $paymentsCustomUrl;
    private static $reportsCustomUrl;
    private static $subscriptionsCustomUrl;

    public static function setPaymentsCustomUrl($url) {
        self::$paymentsCustomUrl = $url;
    }

    public static function getPaymentsCustomUrl() {
        return self::$paymentsCustomUrl;
    }

    public static function setReportsCustomUrl($url) {
        self::$reportsCustomUrl = $url;
    }

    public static function getReportsCustomUrl() {
        return self::$reportsCustomUrl;
    }

    public static function setSubscriptionsCustomUrl($url) {
        self::$subscriptionsCustomUrl = $url;
    }

    public static function getSubscriptionsCustomUrl() {
        return self::$subscriptionsCustomUrl;
    }
}
