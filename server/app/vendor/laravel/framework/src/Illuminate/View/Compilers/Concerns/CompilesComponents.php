<?php

namespace Illuminate\View\Compilers\Concerns;

use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;

trait CompilesComponents
{
    /**
     * The component name hash stack.
     *
     * @var array
     */
    protected static $componentHashStack = [];

    /**
     * Compile the component statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileComponent($expression)
    {
        [$component, $alias, $data] = strpos($expression, ',') !== false
                    ? array_map('trim', explode(',', trim($expression, '()'), 3)) + ['', '', '']
                    : [trim($expression, '()'), '', ''];

        $component = trim($component, '\'"');

        $hash = static::newComponentHash($component);

        if (Str::contains($component, ['::class', '\\'])) {
            return static::compileClassComponentOpening($component, $alias, $data, $hash);
        }

        return "<?php-fpm \$__env->startComponent{$expression}; ?>";
    }

    /**
     * Get a new component hash for a component name.
     *
     * @param  string  $component
     * @return string
     */
    public static function newComponentHash(string $component)
    {
        static::$componentHashStack[] = $hash = sha1($component);

        return $hash;
    }

    /**
     * Compile a class component opening.
     *
     * @param  string  $component
     * @param  string  $alias
     * @param  string  $data
     * @param  string  $hash
     * @return string
     */
    public static function compileClassComponentOpening(string $component, string $alias, string $data, string $hash)
    {
        return implode("\n", [
            '<?php-fpm if (isset($component)) { $__componentOriginal'.$hash.' = $component; } ?>',
            '<?php-fpm $component = $__env->getContainer()->make('.Str::finish($component, '::class').', '.($data ?: '[]').'); ?>',
            '<?php-fpm $component->withName('.$alias.'); ?>',
            '<?php-fpm if ($component->shouldRender()): ?>',
            '<?php-fpm $__env->startComponent($component->resolveView(), $component->data()); ?>',
        ]);
    }

    /**
     * Compile the end-component statements into valid PHP.
     *
     * @return string
     */
    protected function compileEndComponent()
    {
        $hash = array_pop(static::$componentHashStack);

        return implode("\n", [
            '<?php-fpm if (isset($__componentOriginal'.$hash.')): ?>',
            '<?php-fpm $component = $__componentOriginal'.$hash.'; ?>',
            '<?php-fpm unset($__componentOriginal'.$hash.'); ?>',
            '<?php-fpm endif; ?>',
            '<?php-fpm echo $__env->renderComponent(); ?>',
        ]);
    }

    /**
     * Compile the end-component statements into valid PHP.
     *
     * @return string
     */
    public function compileEndComponentClass()
    {
        return $this->compileEndComponent()."\n".implode("\n", [
            '<?php-fpm endif; ?>',
        ]);
    }

    /**
     * Compile the slot statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileSlot($expression)
    {
        return "<?php-fpm \$__env->slot{$expression}; ?>";
    }

    /**
     * Compile the end-slot statements into valid PHP.
     *
     * @return string
     */
    protected function compileEndSlot()
    {
        return '<?php-fpm $__env->endSlot(); ?>';
    }

    /**
     * Compile the component-first statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileComponentFirst($expression)
    {
        return "<?php-fpm \$__env->startComponentFirst{$expression}; ?>";
    }

    /**
     * Compile the end-component-first statements into valid PHP.
     *
     * @return string
     */
    protected function compileEndComponentFirst()
    {
        return $this->compileEndComponent();
    }

    /**
     * Compile the prop statement into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileProps($expression)
    {
        return "<?php-fpm \$attributes = \$attributes->exceptProps{$expression}; ?>
<?php-fpm foreach (array_filter({$expression}, 'is_string', ARRAY_FILTER_USE_KEY) as \$__key => \$__value) {
    \$\$__key = \$\$__key ?? \$__value;
} ?>
<?php-fpm \$__defined_vars = get_defined_vars(); ?>
<?php-fpm foreach (\$attributes as \$__key => \$__value) {
    if (array_key_exists(\$__key, \$__defined_vars)) unset(\$\$__key);
} ?>
<?php-fpm unset(\$__defined_vars); ?>";
    }

    /**
     * Sanitize the given component attribute value.
     *
     * @param  mixed  $value
     * @return mixed
     */
    public static function sanitizeComponentAttribute($value)
    {
        return is_string($value) ||
               (is_object($value) && ! $value instanceof ComponentAttributeBag && method_exists($value, '__toString'))
                        ? e($value)
                        : $value;
    }
}
