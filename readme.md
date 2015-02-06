Samson Unexpected Response Bundle
=================================

Hooks into the deepest level of Symfony exceptions to allow throwing an UnexpectedResponseException, which is caught and forwarded to the client.

This means that you can throw an exception from any level in code, current code flow is aborted, and the response object passed to the UnexpectedResponseException is sent back to the client.