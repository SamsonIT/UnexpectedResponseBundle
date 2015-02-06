<?php

namespace Samson\Bundle\UnexpectedResponseBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Bart van den Burg <bart@samson-it.nl>
 *
 * A bundle that can abort a request at-will and response from any point in code
 * Listens for UnexpectedResponseExceptions on the kernel on level 1024
 */
class SamsonUnexpectedResponseBundle extends Bundle
{
}
