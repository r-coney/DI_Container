<?php
declare(strict_types=1);

interface ContainerInterface
{
    /**
     * DIコンテナのインスタンス作成
     *
     * @return ContainerInterface
     */
    public static function createInstance(): ContainerInterface;

    /**
     * 依存関係の解決
     *
     * @param string $abstract
     * @return mixed $concrete
     */
    public function resolve(string $abstract): mixed;
}
