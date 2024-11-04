<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Assistants
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Assistants\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Values;
use Twilio\Version;
use Twilio\InstanceContext;
use Twilio\Rest\Assistants\V1\Assistant\AssistantsKnowledgeList;
use Twilio\Rest\Assistants\V1\Assistant\AssistantsToolList;
use Twilio\Rest\Assistants\V1\Assistant\FeedbackList;
use Twilio\Rest\Assistants\V1\Assistant\MessageList;


/**
 * @property AssistantsKnowledgeList $assistantsKnowledge
 * @property AssistantsToolList $assistantsTools
 * @property FeedbackList $feedbacks
 * @property MessageList $messages
 * @method \Twilio\Rest\Assistants\V1\Assistant\AssistantsToolContext assistantsTools(string $id)
 * @method \Twilio\Rest\Assistants\V1\Assistant\AssistantsKnowledgeContext assistantsKnowledge(string $id)
 */
class AssistantContext extends InstanceContext
    {
    protected $_assistantsKnowledge;
    protected $_assistantsTools;
    protected $_feedbacks;
    protected $_messages;

    /**
     * Initialize the AssistantContext
     *
     * @param Version $version Version that contains the resource
     * @param string $id
     */
    public function __construct(
        Version $version,
        $id
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'id' =>
            $id,
        ];

        $this->uri = '/Assistants/' . \rawurlencode($id)
        .'';
    }

    /**
     * Delete the AssistantInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool
    {

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded' ]);
        return $this->version->delete('DELETE', $this->uri, [], [], $headers);
    }


    /**
     * Fetch the AssistantInstance
     *
     * @return AssistantInstance Fetched AssistantInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): AssistantInstance
    {

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded' ]);
        $payload = $this->version->fetch('GET', $this->uri, [], [], $headers);

        return new AssistantInstance(
            $this->version,
            $payload,
            $this->solution['id']
        );
    }


    /**
     * Update the AssistantInstance
     *
     * @return AssistantInstance Updated AssistantInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(): AssistantInstance
    {

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded' ]);
        $data = $assistantsV1ServiceUpdateAssistantRequest->toArray();
        $headers['Content-Type'] = 'application/json';
        $payload = $this->version->update('PUT', $this->uri, [], $data, $headers);

        return new AssistantInstance(
            $this->version,
            $payload,
            $this->solution['id']
        );
    }


    /**
     * Access the assistantsKnowledge
     */
    protected function getAssistantsKnowledge(): AssistantsKnowledgeList
    {
        if (!$this->_assistantsKnowledge) {
            $this->_assistantsKnowledge = new AssistantsKnowledgeList(
                $this->version,
                $this->solution['id']
            );
        }

        return $this->_assistantsKnowledge;
    }

    /**
     * Access the assistantsTools
     */
    protected function getAssistantsTools(): AssistantsToolList
    {
        if (!$this->_assistantsTools) {
            $this->_assistantsTools = new AssistantsToolList(
                $this->version,
                $this->solution['id']
            );
        }

        return $this->_assistantsTools;
    }

    /**
     * Access the feedbacks
     */
    protected function getFeedbacks(): FeedbackList
    {
        if (!$this->_feedbacks) {
            $this->_feedbacks = new FeedbackList(
                $this->version,
                $this->solution['id']
            );
        }

        return $this->_feedbacks;
    }

    /**
     * Access the messages
     */
    protected function getMessages(): MessageList
    {
        if (!$this->_messages) {
            $this->_messages = new MessageList(
                $this->version,
                $this->solution['id']
            );
        }

        return $this->_messages;
    }

    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return ListResource The requested subresource
     * @throws TwilioException For unknown subresources
     */
    public function __get(string $name): ListResource
    {
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments): InstanceContext
    {
        $property = $this->$name;
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Assistants.V1.AssistantContext ' . \implode(' ', $context) . ']';
    }
}
