<?php

namespace App\Validator\Constraints;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Validator\Constraint;
use App\Validator\Constraints\EasyAdminFile;
use Symfony\Component\Validator\Constraints\FileValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\Model\FileUploadState;

/**
 * Class EasyAdminFileValidator
 * @package App\Validator\Constraints
 */
class EasyAdminFileValidator extends FileValidator
{
    /**
     * @param mixed $value
     * @param \Symfony\Component\Validator\Constraint $constraint
     * @return void
     */
    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof EasyAdminFile) {
            throw new UnexpectedTypeException($constraint, EasyAdminFile::class);
        }

        if ($value !== null &&
            $this->context->getObject() instanceof Form &&
            $this->context->getObject()->getConfig() instanceof FormBuilder
        ) {
            $config = $this->context->getObject()->getConfig();

            /** @var FileUploadState $state */
            $state = $config->getAttribute('state');

            if (!$state instanceof FileUploadState ||
                !$state->isModified()
            ) {
                return;
            }

            // On the upload field we can set the option for multiple uploads, so we need to take care of this
            foreach ($state->getUploadedFiles() as $index => $file) {
                parent::validate($file, $constraint);
            }
        }
    }
}
