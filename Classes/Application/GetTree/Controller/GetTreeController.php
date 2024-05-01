<?php

/*
 * This script belongs to the package "Sitegeist.Archaeopteryx".
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

declare(strict_types=1);

namespace Sitegeist\Archaeopteryx\Application\GetTree\Controller;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\ActionRequest;
use Neos\Flow\Mvc\ActionResponse;
use Neos\Flow\Mvc\Controller\ControllerInterface;
use Sitegeist\Archaeopteryx\Application\GetTree\GetTreeQuery;
use Sitegeist\Archaeopteryx\Application\GetTree\GetTreeQueryHandler;

#[Flow\Scope("singleton")]
final class GetTreeController implements ControllerInterface
{
    #[Flow\Inject]
    protected GetTreeQueryHandler $queryHandler;

    public function processRequest(ActionRequest $request, ActionResponse $response)
    {
        $request->setDispatched(true);

        $query = $request->getArguments();
        $query = GetTreeQuery::fromArray($query);

        $queryResult = $this->queryHandler->handle($query);

        $response->setContentType('application/json');
        $response->setContent(json_encode([
            'success' => $queryResult
        ], JSON_THROW_ON_ERROR));
    }
}
