<?php namespace Belton\SimpleAdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfoný\Component\Form\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Create a video type for formulare with an interactive javascript
 * plugin that enable to test and valid a video link.
 * 
 * @author david jegat <david.jegat@gmail.com>
 */
class VideoType extends AbstractType {

	/**
	 * @{inheritdoc}
	 */
	public function buildView(FormView $view, FormInterface $form, array $options){
		$data = $this->getParent()->getData();
		if(method_exists($data, 'getVideo')){
			$video = $data->getVideo();
		} else {
			$video = null;
		}
		$view->vars['video'] = $video;
	}

	/**
	 * @{inheritDoc}
	 */
	public function getDefaultOptions(array $options){
		return array(
			'attr' => array(
				'class' => 'video_link'
			)
		) + $options;
	}

	/**
	 * @{inheritdoc}
	 */
	public function getParent(){
		return 'textarea';
	}

}