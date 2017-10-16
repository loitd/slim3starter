* Remember that Respect use exact folder structure to find exceptions

So in the end, the folder structure for your Rules and Exceptions should look something like the structure below. Note that the folders (and namespaces) are plural but the actual Rules and Exceptions are singular.

My
 +-- Validation
     +-- Exceptions
         +-- MyRuleException.php
     +-- Rules
         +-- MyRule.php

(https://github.com/Respect/Validation/blob/master/docs/README.md)