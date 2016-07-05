<?php

namespace Ecodev\Newsletter\ViewHelpers;

/**
 * View helper which allows you to include a CSS File.
 * Note: This feature is experimental!
 * Note: You MUST wrap this Helper with <newsletter:Be.moduleContainer>-Tags
 *
 * = Examples =
 *
 * <newsletter:be.moduleContainer pageTitle="foo">
 * 	<newsletter:includeCssFile name="foo.js" extKey="blog_example" pathInsideExt="Resources/Public/JavaScript" />
 * </newsletter:be.moduleContainer>
 */
class IncludeCssFileViewHelper extends AbstractViewHelper
{
    /**
     * Calls addCssFile on the Instance of TYPO3\CMS\Core\Page\PageRenderer.
     *
     * @param string $name the file to include
     * @param string $extKey the extension, where the file is located
     * @param string $pathInsideExt the path to the file relative to the ext-folder
     * @return string the link
     */
    public function render($name = null, $extKey = null, $pathInsideExt = 'Resources/Public/Styles/')
    {
        if ($extKey === null) {
            $extKey = $this->controllerContext->getRequest()->getControllerExtensionKey();
        }

        if (TYPO3_MODE === 'FE') {
            $extPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($extKey);
            $extRelPath = substr($extPath, strlen(PATH_site));
        } else {
            $extRelPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey);
        }

        $this->pageRenderer->addCssFile($extRelPath . $pathInsideExt . $name);
    }
}
