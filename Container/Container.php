<?php
declare(strict_types=1);

class Container implements ContainerInterface
{
    /**
     * Containerクラスのインスタンス
     *
     * @var Container
     */
    private static $container;

    /**
     * 依存関係
     *
     * @var array
     */
    private $dependencies = [];

    /**
     * Providerから依存系を取得
     */
    private function __construct()
    {
        $provider = new Provider();

        $this->dependencies = $provider->dependencies();
    }

    /**
     * Containerを作成
     * 一度作成したコンテナを使い回すため、このメソッドからのみインスタンス化可能
     *
     * @return ContainerInterface
     */
    public static function createInstance(): ContainerInterface
    {
        if (isset(self::$container)) {
            return self::$container;
        }

        self::$container = new Container();

        return self::$container;
    }

    /**
     * 依存関係の解決
     *
     * @param string $abstract
     * @return mixed $concrete
     */
    public function resolve(string $abstract): mixed
    {
        $concrete = $this->dependencies[$abstract] ?? $abstract;

        $reflection = new ReflectionClass($concrete);
        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) {
            return new $concrete();
        }

        $args = [];
        foreach ($constructor->getParameters() as $parameter) {
            $type = $parameter->getType();
            $args[] = $this->resolve($type->__toString());
        }

        return new $concrete(...$args);
    }
}
