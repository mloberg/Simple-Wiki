# Issues

Here are some of the know issues/bugs with PHP on different systems, etc.

## PHP 5.2

While TFD is compatible with PHP 5.2, you may run into some issues/security flaws if you are running PHP 5.2.

The function TFD uses to encrypt passwords was greatly improved in 5.3. If you are running 5.2, passwords that are close may be accepted.

## PHP 5.3.7

While this was a short release and not many people upgraded to it, there is a bug in this version of PHP that greatly impacts the password encryption function.

## Cross-System Issues

You will also have issues transferring database user info across multiple databases (you could use [migrations](migrations), to get around this), (especially if you are running 5.2) due to the nature of the password encryption method.
