<?php
class PHPUnit_Framework_MockObject_Builder_FluentInvocationMocker extends
		PHPUnit_Framework_MockObject_Builder_InvocationMocker
{
	private $_methodName;
	public function __construct(
			PHPUnit_Framework_MockObject_Stub_MatcherCollection $collection,
			$methodName)
	{
        $this->collection = $collection;
		$this->_methodName = $methodName;
	}
	public function once()
	{
		return $this->_addMatcher(
				new PHPUnit_Framework_MockObject_Matcher_InvokedCount(1));
	}
	public function any()
	{
		return $this->_addMatcher(
				new PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount);
	}
	public function never()
	{
		return $this->_addMatcher(
				new PHPUnit_Framework_MockObject_Matcher_InvokedCount(0));
	}
	public function at($index)
    {
        return $this->_addMatcher(
				new PHPUnit_Framework_MockObject_Matcher_InvokedAtIndex($index));
    }
	public function willReturn($value)
	{
		return $this->will(
				new PHPUnit_Framework_MockObject_Stub_Return($value));
	}
	private function _addMatcher(PHPUnit_Framework_MockObject_Matcher_Invocation $matcher)
	{
		$this->matcher = new PHPUnit_Framework_MockObject_Matcher($matcher);
        $this->collection->addMatcher($this->matcher);
		return $this->method($this->_methodName);
	}
}
?>
