<?php 

namespace App\HelperTraits;


/**
 * Trait to set dependeny injected models as class variables.
 */
trait setControllerVariables
{
	private function setVars()
	{
		$controller = new \ReflectionClass($this);

		$backTrace = debug_backtrace()[1];

		$callingMethod = $backTrace['function'];

		$parameters = $backTrace['args'];

		$parameterNames = $controller->getMethod($callingMethod)->getParameters();

		foreach ($parameters as $parameter) {
			foreach ($parameterNames as $parameterName) {
				if (get_class($parameter) === $parameterName->getClass()->name) {
					$this->{$parameterName->name} = $parameter;					
				}
			}			
		}
	}
}