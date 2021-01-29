<?php

namespace Illuminate\View\Compilers\Concerns;

trait CompilesLoops
{
    /**
     * Counter to keep track of nested forelse statements.
     *
     * @var int
     */
    protected $forElseCounter = 0;

    /**
     * Compile the for-else statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileForelse($expression)
    {
        $empty = '$__empty_'.++$this->forElseCounter;

        preg_match('/\( *(.*) +as *(.*)\)$/is', $expression, $matches);

        $iteratee = trim($matches[1]);

        $iteration = trim($matches[2]);

        $initLoop = "\$__currentLoopData = {$iteratee}; \$__env->addLoop(\$__currentLoopData);";

        $iterateLoop = '$__env->incrementLoopIndices(); $loop = $__env->getLastLoop();';

        return "<?php-fpm {$empty} = true; {$initLoop} foreach(\$__currentLoopData as {$iteration}): {$iterateLoop} {$empty} = false; ?>";
    }

    /**
     * Compile the for-else-empty and empty statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileEmpty($expression)
    {
        if ($expression) {
            return "<?php-fpm if(empty{$expression}): ?>";
        }

        $empty = '$__empty_'.$this->forElseCounter--;

        return "<?php-fpm endforeach; \$__env->popLoop(); \$loop = \$__env->getLastLoop(); if ({$empty}): ?>";
    }

    /**
     * Compile the end-for-else statements into valid PHP.
     *
     * @return string
     */
    protected function compileEndforelse()
    {
        return '<?php-fpm endif; ?>';
    }

    /**
     * Compile the end-empty statements into valid PHP.
     *
     * @return string
     */
    protected function compileEndEmpty()
    {
        return '<?php-fpm endif; ?>';
    }

    /**
     * Compile the for statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileFor($expression)
    {
        return "<?php-fpm for{$expression}: ?>";
    }

    /**
     * Compile the for-each statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileForeach($expression)
    {
        preg_match('/\( *(.*) +as *(.*)\)$/is', $expression, $matches);

        $iteratee = trim($matches[1]);

        $iteration = trim($matches[2]);

        $initLoop = "\$__currentLoopData = {$iteratee}; \$__env->addLoop(\$__currentLoopData);";

        $iterateLoop = '$__env->incrementLoopIndices(); $loop = $__env->getLastLoop();';

        return "<?php-fpm {$initLoop} foreach(\$__currentLoopData as {$iteration}): {$iterateLoop} ?>";
    }

    /**
     * Compile the break statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileBreak($expression)
    {
        if ($expression) {
            preg_match('/\(\s*(-?\d+)\s*\)$/', $expression, $matches);

            return $matches ? '<?php-fpm break '.max(1, $matches[1]).'; ?>' : "<?php-fpm if{$expression} break; ?>";
        }

        return '<?php-fpm break; ?>';
    }

    /**
     * Compile the continue statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileContinue($expression)
    {
        if ($expression) {
            preg_match('/\(\s*(-?\d+)\s*\)$/', $expression, $matches);

            return $matches ? '<?php-fpm continue '.max(1, $matches[1]).'; ?>' : "<?php-fpm if{$expression} continue; ?>";
        }

        return '<?php-fpm continue; ?>';
    }

    /**
     * Compile the end-for statements into valid PHP.
     *
     * @return string
     */
    protected function compileEndfor()
    {
        return '<?php-fpm endfor; ?>';
    }

    /**
     * Compile the end-for-each statements into valid PHP.
     *
     * @return string
     */
    protected function compileEndforeach()
    {
        return '<?php-fpm endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>';
    }

    /**
     * Compile the while statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileWhile($expression)
    {
        return "<?php-fpm while{$expression}: ?>";
    }

    /**
     * Compile the end-while statements into valid PHP.
     *
     * @return string
     */
    protected function compileEndwhile()
    {
        return '<?php-fpm endwhile; ?>';
    }
}
